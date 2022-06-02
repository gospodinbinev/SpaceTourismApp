<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use App\Models\Spacecraft;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSpacecraftRequest;
use App\Http\Requests\UpdateSpacecraftRequest;
use Intervention\Image\Facades\Image;

class SpacecraftController extends Controller
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
        $spacecraft = Spacecraft::all();

        return view('spacecraft.index', compact('spacecraft'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spacecraft.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSpacecraftRequest $request)
    {
        $spacecraft = new Spacecraft();
        
        $spacecraft->name = $request->name;
        $spacecraft->height = $request->height;
        $spacecraft->diameter = $request->diameter;
        $spacecraft->payload = $request->payload;
        
        // Image Upload
        $originalImage = $request->file('image');
        $image = Image::make($originalImage);
        $imagePath = public_path().'/spacecraft_img/';
        $image->save($imagePath.time().$originalImage->getClientOriginalName());

        $spacecraft->image = 'spacecraft_img/'.time().$originalImage->getClientOriginalName();
        $spacecraft->save();

        return redirect()->route('spacecraft.index')->withSuccess('Spacecraft added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spacecraft  $spacecraft
     * @return \Illuminate\Http\Response
     */
    public function show(Spacecraft $spacecraft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spacecraft  $spacecraft
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spacecraft = Spacecraft::findOrFail($id);
        
        return view('spacecraft.edit', compact('spacecraft'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spacecraft  $spacecraft
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpacecraftRequest $request, $id)
    {
        $spacecraft = Spacecraft::findOrFail($id);

        $spacecraft->name = $request->name;
        $spacecraft->height = $request->height;
        $spacecraft->diameter = $request->diameter;
        $spacecraft->payload = $request->payload;

        if ($request->file('image')) {

            // Delete the old file for the current object
            $oldFile = public_path($spacecraft->image);
            File::delete($oldFile);

            // Image Upload
            $originalImage = $request->file('image');
            $image = Image::make($originalImage);
            $imagePath = public_path().'/spacecraft_img/';
            $image->save($imagePath.time().$originalImage->getClientOriginalName());

            // Save image path in db
            $spacecraft->image = 'spacecraft_img/'.time().$originalImage->getClientOriginalName();

        }

        $spacecraft->save();

        return redirect()->route('spacecraft.index')->withSuccess('Spacecraft updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spacecraft  $spacecraft
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spacecraft $spacecraft)
    {
        //
    }
}
