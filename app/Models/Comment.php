<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = "comments";

    /**
     * Get all of the comment's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
