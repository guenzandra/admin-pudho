<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vision extends Model
{
  protected $table = 'vision'; // Changed from 'visions' to 'vision'

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
