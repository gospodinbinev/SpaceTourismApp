<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdditionalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'about', 
        'country', 
        'state', 
        'city', 
        'address_line'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
