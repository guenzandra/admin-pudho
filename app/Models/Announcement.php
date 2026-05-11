<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
  use HasFactory;

  protected $table = 'announcements';

  protected $fillable = [
    'title',
    'content',
    'image',
    'status',
    'author_id',
    'scheduled_date',
    'published_at'
  ];

  protected $casts = [
    'scheduled_date' => 'datetime',
    'published_at' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime'
  ];

  public function author()
  {
    return $this->belongsTo(User::class, 'author_id', 'user_id');
  }
}
