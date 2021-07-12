<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'comment',
        'status',
        'blog_id',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function enabledreplies()
    {
        return $this->replies()->where('status', 1);
    }
}
