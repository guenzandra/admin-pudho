<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class RoleHelper
{
    /**
     * Check if current user has any of the given roles
     */
    public static function hasRole($roles)
    {
        $user = Auth::user();
        
        if (!$user) {
            return false;
        }

        return $user->hasRole($roles);
    }

    /**
     * Check if current user is administrator
     */
    public static function isAdministrator()
    {
        $user = Auth::user();
        return $user && $user->isAdministrator();
    }

    /**
     * Check if current user is head officer
     */
    public static function isHeadOfficer()
    {
        $user = Auth::user();
        return $user && $user->isHeadOfficer();
    }

    /**
     * Check if current user is editor
     */
    public static function isEditor()
    {
        $user = Auth::user();
        return $user && $user->isEditor();
    }

    /**
     * Check if current user is housing officer
     */
    public static function isHousingOfficer()
    {
        $user = Auth::user();
        return $user && $user->isHousingOfficer();
    }

    /**
     * Check if current user is evaluator
     */
    public static function isEvaluator()
    {
        $user = Auth::user();
        return $user && $user->isEvaluator();
    }

    /**
     * Check if current user is staff
     */
    public static function isStaff()
    {
        $user = Auth::user();
        return $user && $user->isStaff();
    }

    /**
     * Check if current user is inspector
     */
    public static function isInspector()
    {
        $user = Auth::user();
        return $user && $user->isInspector();
    }

    /**
     * Check if current user is admin level (role 1-2)
     */
    public static function isAdminLevel()
    {
        $user = Auth::user();
        return $user && $user->isAdminLevel();
    }

    /**
     * Check if current user is management level (role 1-3)
     */
    public static function isManagementLevel()
    {
        $user = Auth::user();
        return $user && $user->isManagementLevel();
    }

    /**
     * Get current user's role name
     */
    public static function getRoleName()
    {
        $user = Auth::user();
        return $user ? $user->role_name : null;
    }

    /**
     * Get current user's role color
     */
    public static function getRoleColor()
    {
        $user = Auth::user();
        return $user ? $user->role_color : 'gray';
    }

    /**
     * Get dashboard route based on role
     */
    public static function getDashboardRoute()
    {
        $user = Auth::user();
        return $user ? $user->getDashboardRoute() : route('admin.login');
    }

    /**
     * Get all available roles
     */
    public static function getAllRoles()
    {
        return [
            ['id' => 1, 'name' => 'Administrator', 'color' => 'red'],
            ['id' => 2, 'name' => 'Head Officer', 'color' => 'blue'],
            ['id' => 3, 'name' => 'Editor', 'color' => 'green'],
            ['id' => 4, 'name' => 'Housing Officer', 'color' => 'purple'],
            ['id' => 5, 'name' => 'Application Evaluator', 'color' => 'yellow'],
            ['id' => 6, 'name' => 'Staff', 'color' => 'gray'],
            ['id' => 7, 'name' => 'Site Inspector', 'color' => 'indigo'],
        ];
    }
}