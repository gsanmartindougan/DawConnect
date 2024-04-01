<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table = "posts";

    /**
     * Get all of the post's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
