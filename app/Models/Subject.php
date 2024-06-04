<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;

class Subject extends Model
{
    use HasFactory;
    protected $table = "subjects";
    protected $fillable = [
        "name",
    ];

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }
    public function course()
    {
        return $this->hasMany(Course::class);
    }
    //con ayuda de chatGPT
    public function recentPosts($limit = 5)
    {
        return $this->posts()->orderBy('created_at', 'desc')->limit($limit)->get();
    }
    public function recentCourse($limit = 5)
    {
        return $this->course()->orderBy('created_at', 'desc')->limit($limit)->get();
    }
}
