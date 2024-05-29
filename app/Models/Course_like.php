<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_like extends Model
{
    use HasFactory;
    protected $table = "course_like";

    public function curso()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

}
