<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
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

    public function thumbnails() {
        return $this->morphMany(Thumbnail::class, 'imageable');
    }

    public function solarSystemApi() {
        $response = Http::get('https://api.le-systeme-solaire.net/rest/bodies/?filter[]=englishName,eq,'.$this->object_id);
        $responseBody = $response->collect();

        return (object) $responseBody['bodies'][0];
    }

    public function lengthOfTheDay($sideralRotation) {
        // Length of day on the astronomical object
        $now = Carbon::now();
        $addHoursToNow = $now->copy()->addRealHours($sideralRotation);
        $lengthOfTheDay = $now->diff($addHoursToNow);
        
        // Check if days are much more
        $days = 0;
        if ($lengthOfTheDay->days > 0) {
            $days = $lengthOfTheDay->days;
        }
        else {
            $days = $lengthOfTheDay->d;
        }

        $lengthOfTheDay = $days.' days '.$lengthOfTheDay->h.' hours '.$lengthOfTheDay->i.' minutes';

        return $lengthOfTheDay;
    }

    public function avgTempKelvinToCelsius($avgTemp) {
        // Convert Kelvin temperature to Celsius
        $tempInCelsius = $avgTemp - 273.15;

        return $tempInCelsius;
    }

    public function availableSpaceflight() {
        return $this->belongsToMany(Spacecraft::class, 'available_spaceflights');
    }
}
