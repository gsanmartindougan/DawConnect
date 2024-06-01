<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'student',
        'teacher',
        'mod',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function post_like()
    {
        return $this->hasMany(Post_like::class, 'user_id', 'id');
    }
    public function course_like()
    {
        return $this->hasMany(Course_like::class, 'user_id', 'id');
    }
    public function posts()
    {
        return $this->hasMany(Posts::class, 'student_id', 'id');
    }
    public function likes()
    {
        return $this->belongsToMany(Posts::class, 'post_like', 'user_id', 'post_id');
    }
    public function likes_curso()
    {
        return $this->belongsToMany(Course::class, 'course_like', 'user_id', 'course_id');
    }
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'user_id', 'id');
    }

    public function avatar()
    {
        return url('storage/' . $this->avatar);
    }

    public function cursos()
    {
        return $this->hasMany(Course::class, 'teacher_id', 'id');
    }

    public function reportPost()
    {
        return $this->hasMany(ReportPost::class, 'user_id', 'id');
    }

    public function reportCurso()
    {
        return $this->hasMany(ReportCourse::class, 'user_id', 'id');
    }

    public function reportComentario()
    {
        return $this->hasMany(ReportComment::class, 'user_id', 'id');
    }
}
