<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportCourse extends Model
{
    use HasFactory;
    protected $table = 'report_course';

    public function user()
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function curso()
    {
        return $this->BelongsTo(Course::class, 'course_id');
    }
}
