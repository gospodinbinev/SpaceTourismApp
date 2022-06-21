<?php

namespace App\Services;

use App\Models\Spacecraft;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class SpacecraftService {

    public function createSpacecraft(Request $request)
    {
        // Create spacecraft
        $spacecraft = new Spacecraft();
        
        $spacecraft->name = $request->name;
        $spacecraft->height = $request->height;
        $spacecraft->diameter = $request->diameter;
        $spacecraft->payload = $request->payload;
        
        // Image Upload
        if ($request->hasFile('image')) {
            $originalImage = $request->file('image');
            $image = Image::make($originalImage);
            $imagePath = public_path().'/spacecraft_img/';
            $image->save($imagePath.time().$originalImage->getClientOriginalName());
        }

        $spacecraft->image = 'spacecraft_img/'.time().$originalImage->getClientOriginalName();
        
        $spacecraft->save();

        return $spacecraft;
    }

    public function updateSpacecraft(Request $request, $id)
    {
        // Update spacecraft
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

        return $spacecraft;
    }

    public function deleteSpacecraft(Request $request, $id)
    {
        $spacecraft = Spacecraft::findOrFail($id);

        // Delete file
        $oldFile = public_path($spacecraft->image);
        File::delete($oldFile);

        $spacecraft->delete();
    }

}