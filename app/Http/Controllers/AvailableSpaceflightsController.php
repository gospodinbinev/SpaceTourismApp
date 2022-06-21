<?php

namespace App\Http\Controllers;

use App\Models\AvailableSpaceflight;
use App\Models\AstronomicalObject;
use App\Models\Spacecraft;
use App\Http\Requests\CreateAvailableSpaceflightRequest;
use App\Services\AvailableSpaceflightService;
use Illuminate\Http\Request;

class AvailableSpaceflightsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $availableSpaceflights = AvailableSpaceflight::orderBy('id', 'desc')->get();

        return view('available-spaceflights.index', compact('availableSpaceflights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $astronomicalObjects = AstronomicalObject::orderBy('id', 'asc')->get();
        $spacecraft = Spacecraft::orderBy('id', 'asc')->get();
        $formattedAstronomicalObjects = [];
        $formattedSpacecraft = [];

        foreach ($astronomicalObjects as $object) {
            $formattedAstronomicalObjects += [$object->id => $object->object_id];
        }

        foreach ($spacecraft as $vehicle) {
            $formattedSpacecraft += [$vehicle->id => $vehicle->name];
        }

        return view('available-spaceflights.create', compact('formattedAstronomicalObjects', 'formattedSpacecraft'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAvailableSpaceflightRequest $request, AvailableSpaceflightService $availableSpaceflightService)
    {
        $availableSpaceflight = $availableSpaceflightService->createAvailableSpaceflight($request);

        return redirect()->route('available-spaceflights.index')->withSuccess('Available Spaceflight added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AvailableSpaceflight  $availableSpaceflight
     * @return \Illuminate\Http\Response
     */
    public function show(AvailableSpaceflight $availableSpaceflight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AvailableSpaceflight  $availableSpaceflight
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $availableSpaceflight = AvailableSpaceflight::findOrFail($id);

        $astronomicalObjects = AstronomicalObject::orderBy('id', 'asc')->get();
        $spacecraft = Spacecraft::orderBy('id', 'asc')->get();
        $formattedAstronomicalObjects = [];
        $formattedSpacecraft = [];

        foreach ($astronomicalObjects as $object) {
            $formattedAstronomicalObjects += [$object->id => $object->object_id];
        }

        foreach ($spacecraft as $vehicle) {
            $formattedSpacecraft += [$vehicle->id => $vehicle->name];
        }

        return view('available-spaceflights.edit', compact('availableSpaceflight', 'formattedAstronomicalObjects', 'formattedSpacecraft'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AvailableSpaceflight  $availableSpaceflight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AvailableSpaceflightService $availableSpaceflightService, $id)
    {
        $availableSpaceflight = $availableSpaceflightService->updateAvailableSpaceflight($request, $id);

        return redirect()->route('available-spaceflights.index')->withSuccess('Available Spaceflight updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AvailableSpaceflight  $availableSpaceflight
     * @return \Illuminate\Http\Response
     */
    public function destroy(AvailableSpaceflightService $availableSpaceflightService, $id)
    {
        $availableSpaceflight = $availableSpaceflightService->deleteAvailableSpaceflight($id);

        return redirect()->route('available-spaceflights.index')->withSuccess('Available Spaceflight deleted successfully!');
    }
}
