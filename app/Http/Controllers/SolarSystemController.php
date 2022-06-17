<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Response;

Use App\Models\AstronomicalObject;
use App\Models\Spacecraft;
use Illuminate\Http\Request;

class SolarSystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Home page of the app
    public function dashboard()
    {
        $planets = AstronomicalObject::orderBy('id', 'asc')->get();

        // API data for main planets
        $responseOnlyPlanets = Http::get('https://api.le-systeme-solaire.net/rest/bodies/?filter[]=bodyType,eq,Planet');
        $planetsApi = $responseOnlyPlanets->collect();

        // Data assign from API to Eloquent collection 
        foreach ($planets as $planet) {

            foreach ($planetsApi['bodies'] as $planetApi) {

                if ($planet->object_id == $planetApi['englishName']) {
                
                    $planet->semimajorAxis = $planetApi['semimajorAxis'];
                    $planet->perihelion = $planetApi['perihelion'];
                    $planet->aphelion = $planetApi['aphelion'];

                }

            }
        
        }

        return view('dashboard', compact('planets'));
    }

    // Listing information about an astronomical object
    public function showAstronomicalObject($object_id)
    {
        $astronomicalObject = AstronomicalObject::where('object_id', $object_id)->first();

        // API data for the current astronomical object
        $response = Http::get('https://api.le-systeme-solaire.net/rest/bodies/?filter[]=englishName,eq,'.$astronomicalObject->object_id);
        $astronomicalObjectApi = $response->collect();

        // Data assign from API to Eloquent collection
        foreach ($astronomicalObjectApi['bodies'] as $body) {
 
            $astronomicalObject->bodyType = $body['bodyType'];
            $astronomicalObject->semimajorAxis = $body['semimajorAxis'];
            $astronomicalObject->perihelion = $body['perihelion'];
            $astronomicalObject->aphelion = $body['aphelion'];
            $astronomicalObject->eccentricity = $body['eccentricity'];
            $astronomicalObject->inclination = $body['inclination'];
            $astronomicalObject->massValue = $body['mass']['massValue'];
            $astronomicalObject->gravity = $body['gravity'];
            $astronomicalObject->meanRadius = $body['meanRadius'];

                // Length of day on the astronomical object
                $now = Carbon::now();
                $addHoursToNow = $now->copy()->addRealHours($body['sideralRotation']);
                $lengthOfTheDay = $now->diff($addHoursToNow);
                
                // Check if days are much more
                $days = 0;
                if ($lengthOfTheDay->days > 0) {
                    $days = $lengthOfTheDay->days;
                }
                else {
                    $days = $lengthOfTheDay->d;
                }

            $astronomicalObject->sideralRotation = $days.' days '.$lengthOfTheDay->h.' hours '.$lengthOfTheDay->i.' minutes';
            $astronomicalObject->avgTemp = $body['avgTemp'] - 273.15; // Convert Kelvin temperature to Celsius
            $astronomicalObject->axialTilt = $body['axialTilt'];


        }

        return view('astro-object', compact('astronomicalObject'));
    }


    // Search for astronomical objects
    public function search(Request $request) {
        
        if ($request->ajax()) {

            $output = "";

            $astronomicalObjects = AstronomicalObject::where('object_id', 'LIKE', '%'.$request->search.'%')->get();
            
            if ($astronomicalObjects) {
                foreach ($astronomicalObjects as $astroObject) {

                    $output.='<li><a class="dropdown-item" href="'.route('show_astro_object', $astroObject->object_id).'">'.$astroObject->object_id."</a></li>";
                
                }
            }

            return Response($output);

        };
        
    }

    public function spacecraftList() {
        $spacecraft = Spacecraft::orderBy('id', 'desc')->get();
        
        return view('spacecraft', compact('spacecraft'));
    }

    // test api
    public function fetch() {
        $responseOnlyPlanets = Http::get('https://api.le-systeme-solaire.net/rest/bodies/?filter[]=name,eq,Phobos');
        $planetsApi = $responseOnlyPlanets->collect();

        dd($planetsApi);
    }
}
