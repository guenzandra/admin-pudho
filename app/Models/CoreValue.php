<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoreValue extends Model
{
  protected $table = 'core_values'; // This is correct (plural)

  protected $fillable = [
    'content',
    'author_id',
    'value_title',
    'order',
    'published_at',
    'is_active'
  ];

  protected $casts = [
    'published_at' => 'datetime',
    'is_active' => 'boolean',
    'order' => 'integer'
  ];

  public function author(): BelongsTo
  {
    return $this->belongsTo(User::class, 'author_id', 'user_id');
  }
}
