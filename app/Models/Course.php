<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id');
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
        return $this->belongsToMany(User::class, 'course_like');
    }
}
