<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Main dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get role-specific data
        $stats = $this->getDashboardStats($user);
        
        return view('admin.dashboard', compact('user', 'stats'));
    }

    /**
     * Housing officer dashboard
     */
    public function housingDashboard()
    {
        $user = Auth::user();
        
        return view('admin.housing-dashboard', compact('user'));
    }

    /**
     * Evaluator dashboard
     */
    public function evaluatorDashboard()
    {
        $user = Auth::user();
        
        return view('admin.evaluator-dashboard', compact('user'));
    }

    /**
     * Inspector dashboard
     */
    public function inspectorDashboard()
    {
        $user = Auth::user();
        
        return view('admin.inspector-dashboard', compact('user'));
    }

    /**
     * Get dashboard stats based on role
     */
    private function getDashboardStats($user)
    {
        $stats = [];
        
        switch ($user->role_no) {
            case 1: // Administrator
                $stats['total_users'] = User::where('is_anonymous', false)->count();
                $stats['active_users'] = User::where('is_anonymous', false)->where('is_active', true)->count();
                $stats['archived_users'] = User::onlyTrashed()->count();
                $stats['recent_logins'] = User::whereNotNull('last_login_at')
                    ->orderBy('last_login_at', 'desc')
                    ->limit(5)
                    ->get();
                break;
                
            case 2: // Head Officer
                // Add head officer specific stats
                break;
                
            case 4: // Housing Officer
                // Add housing officer specific stats
                break;
                
            // Add other roles as needed
        }
        
        return $stats;
    }
}