<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'category_id',
        'description',
        'content',
        'media_path',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the user that owns the post
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Get the category that the post belongs to
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}