<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PermissionHelper
{
    /**
     * Check if current user has permission
     */
    public static function can($module, $action = null)
    {
        $user = Auth::user();
        
        if (!$user) {
            return false;
        }

        return \App\Http\Controllers\Admin\AuthController::hasPermission($user, $module, $action);
    }

    /**
     * Check if user has any of the given roles
     */
    public static function hasRole($roles)
    {
        $user = Auth::user();
        
        if (!$user) {
            return false;
        }

        $roleMap = [
            1 => 'administrator',
            2 => 'head-officer',
            3 => 'editor',
            4 => 'housing-officer',
            5 => 'evaluator',
            6 => 'staff',
            7 => 'inspector',
        ];

        $userRole = $roleMap[$user->role_no] ?? 'unknown';
        
        return in_array($userRole, (array) $roles);
    }

    /**
     * Get current user's role name
     */
    public static function getRoleName()
    {
        $user = Auth::user();
        
        if (!$user) {
            return null;
        }

        $roleMap = [
            1 => 'Administrator',
            2 => 'Head Officer',
            3 => 'Editor',
            4 => 'Housing Officer',
            5 => 'Application Evaluator',
            6 => 'Staff',
            7 => 'Site Inspector',
        ];

        return $roleMap[$user->role_no] ?? 'Unknown';
    }
}