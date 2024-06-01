<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportComment extends Model
{
    use HasFactory;
    protected $table = 'report_comment';

    public function user()
    {
        return $this->BelongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->BelongsTo(Comment::class, 'comment_id');
    }
}
