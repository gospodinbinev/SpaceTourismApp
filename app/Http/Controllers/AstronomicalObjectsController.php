<?php

namespace App\Http\Controllers;

use App\Models\AstronomicalObject;
use App\Http\Requests\CreateAstronomicalObjectRequest;
use App\Http\Requests\UpdateAstronomicalObjectRequest;

use App\Services\AstronomicalObjectService;

use Illuminate\Http\Request;

class AstronomicalObjectsController extends Controller
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
        $astronomicalObjects = AstronomicalObject::orderBy('id', 'desc')->paginate();

        return view('astronomical-objects.index', compact('astronomicalObjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('astronomical-objects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAstronomicalObjectRequest $request, AstronomicalObjectService $astronomicalObjectService)
    {
        $astronomicalObject = $astronomicalObjectService->createAstronomicalObject($request);

        return redirect()->route('astronomical-objects.index')->withSuccess('Astronomical Object added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AstronomicalObject  $astronomicalObject
     * @return \Illuminate\Http\Response
     */
    public function show(AstronomicalObject $astronomicalObject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AstronomicalObject  $astronomicalObject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $astronomicalObject = AstronomicalObject::findOrFail($id);

        return view('astronomical-objects.edit', compact('astronomicalObject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AstronomicalObject  $astronomicalObject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAstronomicalObjectRequest $request, AstronomicalObjectService $astronomicalObjectService, $id)
    {
        $astronomicalObject = $astronomicalObjectService->updateAstronomicalObject($request, $id);

        return redirect()->route('astronomical-objects.index')->withSuccess('Astronomical Object updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AstronomicalObject  $astronomicalObject
     * @return \Illuminate\Http\Response
     */
    public function destroy(AstronomicalObject $astronomicalObject)
    {
        //
    }
}
