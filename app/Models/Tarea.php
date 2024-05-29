<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $table = 'task';
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'state_id');
    }
}
