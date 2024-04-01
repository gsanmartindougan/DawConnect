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
    ] ;

    public function posts()
    {
        return $this->hasMany(Posts::class);
    }

    public function recentPosts($limit = 5)
    {
        // Cargar los últimos posts de esta asignatura ordenados por fecha de creación descendente
        return $this->posts()->orderBy('created_at', 'desc')->limit($limit)->get();
    }
}
