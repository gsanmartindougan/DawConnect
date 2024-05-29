<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table = "posts";
    protected $fillable = [
        'title',
        'content',
        'like'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    public function asignatura()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function likes_count()
    {
        $this->increment('likes');
    }
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'post_like');
    }

}
