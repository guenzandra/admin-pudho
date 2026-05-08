<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'user_id';

    // Role Constants
    const ROLE_ADMINISTRATOR = 1;
    const ROLE_HEAD_OFFICER = 2;
    const ROLE_EDITOR = 3;
    const ROLE_HOUSING_OFFICER = 4;
    const ROLE_EVALUATOR = 5;
    const ROLE_STAFF = 6;
    const ROLE_INSPECTOR = 7;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'contact_no',
        'email',
        'username', 
        'birthdate',
        'age',
        'gender',
        'address',
        'province',
        'municipality',
        'barangay',
        'zip_code',
        'profile_img',
        'bio',
        'role_no',
        'position',
        'password',
        'is_anonymous',
        'is_active',
        'is_verified',
        'verified_by',
        'timezone',
        'locale',
        'last_login_ip',
        'last_login_at',
        'login_attempts',
        'locked_until',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'date',
        'is_anonymous' => 'boolean',
        'is_active' => 'boolean',
        'is_verified' => 'boolean',
        'last_login_at' => 'datetime',
        'locked_until' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . ' ' . $this->suffix);
    }

    /**
     * Get the user's initials.
     */
    public function getInitialsAttribute()
    {
        $firstInitial = $this->first_name ? substr($this->first_name, 0, 1) : '';
        $lastInitial = $this->last_name ? substr($this->last_name, 0, 1) : '';
        return strtoupper($firstInitial . $lastInitial);
    }

    /**
     * Get role name attribute
     */
    public function getRoleNameAttribute()
    {
        return match ($this->role_no) {
            self::ROLE_ADMINISTRATOR => 'Administrator',
            self::ROLE_HEAD_OFFICER => 'Head Officer',
            self::ROLE_EDITOR => 'Editor',
            self::ROLE_HOUSING_OFFICER => 'Housing Officer',
            self::ROLE_EVALUATOR => 'Application Evaluator',
            self::ROLE_STAFF => 'Staff',
            self::ROLE_INSPECTOR => 'Site Inspector',
            default => 'Unknown',
        };
    }

    /**
     * Get role color for UI
     */
    public function getRoleColorAttribute()
    {
        return match ($this->role_no) {
            self::ROLE_ADMINISTRATOR => 'red',
            self::ROLE_HEAD_OFFICER => 'blue',
            self::ROLE_EDITOR => 'green',
            self::ROLE_HOUSING_OFFICER => 'purple',
            self::ROLE_EVALUATOR => 'yellow',
            self::ROLE_STAFF => 'gray',
            self::ROLE_INSPECTOR => 'indigo',
            default => 'gray',
        };
    }

    /**
     * Get status text attribute
     */
    public function getStatusTextAttribute()
    {
        return $this->is_active ? 'active' : 'inactive';
    }

    /**
     * Check if user has specific role
     */
    public function hasRole($role)
    {
        $roles = is_array($role) ? $role : [$role];
        
        $roleMap = [
            'administrator' => self::ROLE_ADMINISTRATOR,
            'head-officer' => self::ROLE_HEAD_OFFICER,
            'editor' => self::ROLE_EDITOR,
            'housing-officer' => self::ROLE_HOUSING_OFFICER,
            'evaluator' => self::ROLE_EVALUATOR,
            'staff' => self::ROLE_STAFF,
            'inspector' => self::ROLE_INSPECTOR,
        ];

        foreach ($roles as $roleKey) {
            if (isset($roleMap[$roleKey]) && $this->role_no === $roleMap[$roleKey]) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user is administrator
     */
    public function isAdministrator()
    {
        return $this->role_no === self::ROLE_ADMINISTRATOR;
    }

    /**
     * Check if user is head officer
     */
    public function isHeadOfficer()
    {
        return $this->role_no === self::ROLE_HEAD_OFFICER;
    }

    /**
     * Check if user is editor
     */
    public function isEditor()
    {
        return $this->role_no === self::ROLE_EDITOR;
    }

    /**
     * Check if user is housing officer
     */
    public function isHousingOfficer()
    {
        return $this->role_no === self::ROLE_HOUSING_OFFICER;
    }

    /**
     * Check if user is evaluator
     */
    public function isEvaluator()
    {
        return $this->role_no === self::ROLE_EVALUATOR;
    }

    /**
     * Check if user is staff
     */
    public function isStaff()
    {
        return $this->role_no === self::ROLE_STAFF;
    }

    /**
     * Check if user is inspector
     */
    public function isInspector()
    {
        return $this->role_no === self::ROLE_INSPECTOR;
    }

    /**
     * Check if user is admin level (role 1-2)
     */
    public function isAdminLevel()
    {
        return in_array($this->role_no, [self::ROLE_ADMINISTRATOR, self::ROLE_HEAD_OFFICER]);
    }

    /**
     * Check if user is management level (role 1-3)
     */
    public function isManagementLevel()
    {
        return in_array($this->role_no, [
            self::ROLE_ADMINISTRATOR, 
            self::ROLE_HEAD_OFFICER, 
            self::ROLE_EDITOR
        ]);
    }

    /**
     * Get dashboard route for user
     */
    public function getDashboardRoute()
    {
        return match ($this->role_no) {
            self::ROLE_ADMINISTRATOR,
            self::ROLE_HEAD_OFFICER,
            self::ROLE_STAFF => route('admin.dashboard', [], false),
            
            self::ROLE_EDITOR => route('editor.dashboard', [], false),
            
            self::ROLE_HOUSING_OFFICER => route('admin.housing.dashboard', [], false),
            
            self::ROLE_EVALUATOR => route('admin.evaluator.dashboard', [], false),
            
            self::ROLE_INSPECTOR => route('admin.inspector.dashboard', [], false),
            
            default => route('admin.dashboard', [], false),
        };
    }

    /**
     * Get user's permissions
     */
    public function getPermissionsAttribute()
    {
        // This will be implemented when we create the AuthController
        return [];
    }

    /**
     * Check if user can perform an action
     */
    public function can($ability, $arguments = [])
    {
        // For basic permission checking, you can implement this
        // For now, return true for administrators
        if ($this->isAdministrator()) {
            return true;
        }
        
        // You can expand this with more sophisticated permission checking
        return parent::can($ability, $arguments);
    }

    /**
     * Scope a query to only include active users.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include inactive users.
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope a query to only include users with a specific role.
     */
    public function scopeRole($query, $roleNo)
    {
        return $query->where('role_no', $roleNo);
    }

    /**
     * Scope a query to only include admin/staff (non-anonymous).
     */
    public function scopeStaff($query)
    {
        return $query->where('is_anonymous', false);
    }

    /**
     * Scope a query to only include app users (anonymous).
     */
    public function scopeAppUsers($query)
    {
        return $query->where('is_anonymous', true);
    }

    /**
     * Get the user's age.
     */
    public function getAgeAttribute()
    {
        if (!$this->birthdate) {
            return null;
        }
        
        return $this->birthdate->age;
    }

    /**
     * Check if account is locked.
     */
    public function isLocked()
    {
        return $this->locked_until && now()->lt($this->locked_until);
    }

    /**
     * Get minutes until account is unlocked.
     */
    public function getLockedMinutesRemainingAttribute()
    {
        if (!$this->isLocked()) {
            return 0;
        }
        
        return now()->diffInMinutes($this->locked_until);
    }

    /**
     * Relationship with verified by user.
     */
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by', 'user_id');
    }

    /**
     * Relationship with activity logs.
     */
    public function activityLogs()
    {
        return $this->hasMany(UserActivityLog::class, 'user_id', 'user_id');
    }

    /**
     * Relationship with notifications.
     */
    public function notifications()
    {
        return $this->hasMany(UserNotification::class, 'user_id', 'user_id');
    }

    /**
     * Relationship with devices.
     */
    public function devices()
    {
        return $this->hasMany(UserDevice::class, 'user_id', 'user_id');
    }
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}