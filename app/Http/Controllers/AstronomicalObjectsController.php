<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use App\Models\AstronomicalObject;
use App\Http\Requests\CreateAstronomicalObjectRequest;
use App\Http\Requests\UpdateAstronomicalObjectRequest;

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
    public function store(CreateAstronomicalObjectRequest $request)
    {
        //

        $astronomicalObject = new AstronomicalObject();
        $astronomicalObject->object_id = $request->object_id;
        $astronomicalObject->description = $request->description;
        
        // File upload
        $file = $request->file('file_path');
        $fileName = $file->getClientOriginalName();
        $file->move('astronomical-3d-models', $fileName);

        $astronomicalObject->file_path = 'astronomical-3d-models/'.$fileName;
        $astronomicalObject->save();

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
        //

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
    public function update(UpdateAstronomicalObjectRequest $request, $id)
    {
        //
        $astronomicalObject = AstronomicalObject::findOrFail($id);
        $astronomicalObject->object_id = $request->object_id;
        $astronomicalObject->description = $request->description;

        if ($request->file('file_path')) {

            // Delete the old file for the current object
            $oldFile = public_path($astronomicalObject->file_path);
            File::delete($oldFile);

            // File upload
            $file = $request->file('file_path');
            $fileName = $file->getClientOriginalName();
            $file->move('astronomical-3d-models', $fileName);

            // Save file path in db
            $astronomicalObject->file_path = 'astronomical-3d-models/'.$fileName;

        }

        $astronomicalObject->save();

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
