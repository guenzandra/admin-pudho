<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Show login page
     */
    public function showLoginForm()
    {
        // If already logged in, redirect to appropriate dashboard
        if (Auth::check()) {
            $user = Auth::user();
            return redirect($user->getDashboardRoute());
        }
        
        return view('welcome');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
            'remember' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Attempt to find user by username or email
        $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->where('is_anonymous', false)
                    ->first();

        // Check if user exists and is active
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Check if account is locked
        if ($user->isLocked()) {
            $minutesLeft = $user->locked_minutes_remaining;
            return response()->json([
                'success' => false,
                'message' => "Account is locked. Please try again after {$minutesLeft} minutes."
            ], 403);
        }

        // Check password
        if (!Hash::check($request->password, $user->password)) {
            // Increment login attempts
            $user->increment('login_attempts');
            
            // Lock account after 5 failed attempts
            if ($user->login_attempts >= 5) {
                $user->locked_until = Carbon::now()->addMinutes(30);
                $user->save();
                
                return response()->json([
                    'success' => false,
                    'message' => 'Too many failed attempts. Account locked for 30 minutes.'
                ], 403);
            }
            
            $user->save();
            
            $attemptsLeft = 5 - $user->login_attempts;
            return response()->json([
                'success' => false,
                'message' => "Invalid credentials. {$attemptsLeft} attempts remaining."
            ], 401);
        }

        // Check if user is active
        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is deactivated. Please contact administrator.'
            ], 403);
        }

        // Attempt login
        if (Auth::attempt([
            'username' => $user->username, 
            'password' => $request->password
        ], $request->remember)) {
            
            // Reset login attempts
            $user->login_attempts = 0;
            $user->locked_until = null;
            $user->last_login_at = Carbon::now();
            $user->last_login_ip = $request->ip();
            $user->save();

            // Log activity
            $this->logActivity($user, 'logged_in', 'User logged in successfully');

            // Determine redirect based on role
            $redirectUrl = $user->getDashboardRoute();

            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => [
                    'id' => $user->user_id,
                    'name' => $user->full_name,
                    'email' => $user->email,
                    'role' => $user->role_name,
                    'role_no' => $user->role_no,
                ],
                'redirect' => $redirectUrl
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Login failed'
        ], 401);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        
        if ($user) {
            $this->logActivity($user, 'logged_out', 'User logged out');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully'
            ]);
        }

        return redirect()->route('welcome');
    }

    /**
     * Log user activity
     */
    private function logActivity($user, $action, $description)
    {
        try {
            \DB::table('user_activity_logs')->insert([
                'user_id' => $user->user_id,
                'action' => $action,
                'description' => $description,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to log activity: ' . $e->getMessage());
        }
    }
}