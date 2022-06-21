<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableSpaceflight extends Model
{
    use HasFactory;

    public function astronomicalObject() {
        return $this->belongsTo(AstronomicalObject::class);
    }

    public function spacecraft() {
        return $this->belongsTo(Spacecraft::class);
    }
}
