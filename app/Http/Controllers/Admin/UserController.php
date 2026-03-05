<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of users with filtering and pagination.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) like ?", ["%{$search}%"]);
            });
        }

        // Apply position filter
        if ($request->filled('position') && $request->position != 'all') {
            $query->where('position', $request->position);
        }

        // Apply status filter - using is_active boolean
        if ($request->filled('status') && $request->status != 'all') {
            if ($request->status == 'active') {
                $query->where('is_active', true);
            } else if ($request->status == 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Only show non-anonymous users (staff/admin)
        $query->where('is_anonymous', false);

        // Order by latest first
        $query->orderBy('created_at', 'desc');

        // Paginate results
        $users = $query->paginate($request->per_page ?? 10);

        // Add full name, initials, and status text to each user
        $users->getCollection()->transform(function ($user) {
            $user->full_name = trim($user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . ' ' . $user->suffix);
            $user->initials = strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name ?? '', 0, 1));
            $user->status_text = $user->is_active ? 'active' : 'inactive';
            return $user;
        });

        // Get archived count
        $archivedCount = User::onlyTrashed()->count();

        return response()->json([
            'success' => true,
            'users' => $users,
            'archived_count' => $archivedCount
        ]);
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:50',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username|max:100',
            'contact_no' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other,prefer_not_to_say',
            'birthdate' => 'required|date|before:-18 years',
            'position' => 'required|string|max:100',
            'password' => 'required|string|min:8',
            'profile_img' => 'nullable|image|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle profile image upload
        $profilePath = null;
        if ($request->hasFile('profile_img')) {
            $profilePath = $request->file('profile_img')->store('profiles', 'public');
        }

        // Create user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
            'suffix' => $request->suffix,
            'email' => $request->email,
            'username' => $request->username,
            'contact_no' => $request->contact_no,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'position' => $request->position,
            'password' => Hash::make($request->password),
            'profile_img' => $profilePath,
            'is_anonymous' => false,
            'is_active' => true,
            'role_no' => $this->getRoleNoFromPosition($request->position)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'user' => $user
        ]);
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $user->full_name = trim($user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name . ' ' . $user->suffix);
        $user->initials = strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name ?? '', 0, 1));
        $user->status_text = $user->is_active ? 'active' : 'inactive';

        // Get user stats
        $stats = [
            'date_joined' => $user->created_at ? $user->created_at->format('F d, Y') : 'N/A',
            'last_login' => $user->last_login_at ? Carbon::parse($user->last_login_at)->format('F d, Y h:i A') : 'Never'
        ];

        return response()->json([
            'success' => true,
            'user' => $user,
            'stats' => $stats
        ]);
    }

    /**
     * Update user status.
     */
    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:active,inactive'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $user->is_active = ($request->status == 'active');
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User status updated successfully',
            'status' => $request->status
        ]);
    }

    /**
     * Generate a unique username.
     */
    public function generateUsername(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string',
                'last_name' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $firstName = preg_replace('/[^a-zA-Z]/', '', $request->first_name);
            $lastName = preg_replace('/[^a-zA-Z]/', '', $request->last_name);
            
            $firstInitial = !empty($firstName) ? strtolower(substr($firstName, 0, 1)) : 'u';
            $lastNamePart = !empty($lastName) ? strtolower($lastName) : 'ser';
            
            $base = $firstInitial . $lastNamePart;
            
            if (empty($base)) {
                $base = 'user';
            }
            
            $username = $base;
            $counter = 1;

            while (User::where('username', $username)->exists()) {
                $username = $base . $counter;
                $counter++;
            }

            return response()->json([
                'success' => true,
                'username' => $username
            ]);

        } catch (\Exception $e) {
            Log::error('Username generation error: ' . $e->getMessage());
            
            return response()->json([
                'success' => true,
                'username' => 'user' . rand(1000, 9999)
            ]);
        }
    }

    /**
     * Soft delete user (move to archive).
     */
    public function archive($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User moved to archive'
        ]);
    }

    /**
     * Get archived users.
     */
    public function getArchived()
    {
        $archivedUsers = User::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->get()
            ->map(function ($user) {
                return [
                    'archive_id' => $user->user_id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'middle_name' => $user->middle_name,
                    'suffix' => $user->suffix,
                    'position' => $user->position,
                    'archived_at' => $user->deleted_at,
                    'expires_at' => Carbon::parse($user->deleted_at)->addDays(30)
                ];
            });

        $stats = [
            'total' => $archivedUsers->count(),
            'expired' => $archivedUsers->filter(function ($user) {
                return Carbon::parse($user['expires_at'])->isPast();
            })->count()
        ];

        return response()->json([
            'success' => true,
            'archived_users' => $archivedUsers,
            'stats' => $stats
        ]);
    }

    /**
     * Restore archived user.
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Archived user not found'
            ], 404);
        }

        $user->restore();

        return response()->json([
            'success' => true,
            'message' => 'User restored successfully'
        ]);
    }

    /**
     * Permanently delete user.
     */
    public function permanentDelete($id)
    {
        $user = User::onlyTrashed()->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Archived user not found'
            ], 404);
        }

        // Delete profile image if exists
        if ($user->profile_img && Storage::disk('public')->exists($user->profile_img)) {
            Storage::disk('public')->delete($user->profile_img);
        }

        $user->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'User permanently deleted'
        ]);
    }

    /**
     * Empty recycle bin (delete expired items).
     */
    public function emptyRecycleBin()
    {
        $expiredUsers = User::onlyTrashed()
            ->where('deleted_at', '<', Carbon::now()->subDays(30))
            ->get();

        foreach ($expiredUsers as $user) {
            if ($user->profile_img && Storage::disk('public')->exists($user->profile_img)) {
                Storage::disk('public')->delete($user->profile_img);
            }
            $user->forceDelete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Recycle bin emptied'
        ]);
    }

    /**
     * Get role number from position.
     */
    private function getRoleNoFromPosition($position)
    {
        return match ($position) {
            'Administrator' => 1,
            'HeadOfficer' => 2,
            'Editor' => 3,
            'HousingOfficer' => 4,
            'ApplicationEvaluator' => 5,
            'Staff' => 6,
            'SiteInspector' => 7,
            default => 6,
        };
    }
}