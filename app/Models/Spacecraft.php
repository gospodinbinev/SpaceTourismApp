<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spacecraft extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'height',
        'diameter',
        'payload',
        'image'
    ];
}
