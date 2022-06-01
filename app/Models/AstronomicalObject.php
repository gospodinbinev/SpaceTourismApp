<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AstronomicalObject extends Model
{
    use HasFactory;

    protected $fillable = [
        'object_id',
        'description',
        'file_path'
    ];
}
