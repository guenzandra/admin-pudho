<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivedUser extends Model
{
    use HasFactory;

    protected $table = 'archived_users';
    
    protected $primaryKey = 'archive_id';
    
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email',
        'position',
        'archived_data',
        'archived_by',
        'archived_at',
        'expires_at',
    ];

    protected $casts = [
        'archived_data' => 'array',
        'archived_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    // Relationship with archiver (admin who archived)
    public function archivedBy()
    {
        return $this->belongsTo(User::class, 'archived_by', 'user_id');
    }

    // Check if expired (30 days)
    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }
}