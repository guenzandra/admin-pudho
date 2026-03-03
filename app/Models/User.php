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
}