<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MissionStatement extends Model
{
  protected $table = 'mission_statements'; // Use plural - matches your migration

  protected $fillable = [
    'content',
    'author_id',
    'published_at',
    'is_active'
  ];

  protected $casts = [
    'published_at' => 'datetime',
    'is_active' => 'boolean'
  ];

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'author_id', 'user_id');
  }
}
