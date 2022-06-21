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
        $response = Http::get('https://api.le-systeme-solaire.net/rest/bodies/?filter[]=bodyType,eq,Planet');
        $responseBody = $response->collect();
        $responseBodyToObject = (object) $responseBody['bodies'];
        
        $planets = AstronomicalObject::orderBy('id', 'asc')->get();

        foreach ($responseBodyToObject as $body) {
            $body = (object) $body;
            foreach ($planets as $planet) {
                if ($body->englishName == $planet->object_id) {
                    $planet->semimajorAxis = $body->semimajorAxis;
                    $planet->perihelion = $body->perihelion;
                    $planet->aphelion = $body->aphelion; 
                }
            }
        }

        return view('dashboard', compact('planets'));
    }

    // Listing information about an astronomical object
    public function showAstronomicalObject($object_id)
    {
        $astronomicalObject = AstronomicalObject::where('object_id', $object_id)->first();

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
        $responseOnlyPlanets = Http::get('https://api.le-systeme-solaire.net/rest/bodies/?filter[]=englishName,eq,Moon');
        $planetsApi = $responseOnlyPlanets->collect();

        dd($planetsApi);
    }
}
