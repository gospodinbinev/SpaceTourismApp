<?php

namespace App\Services;

use App\Models\AstronomicalObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AstronomicalObjectService {
    
    public function createAstronomicalObject(Request $request)
    {
        // Create astronomical object
        $astronomicalObject = new AstronomicalObject();
        $astronomicalObject->object_id = $request->object_id;
        $astronomicalObject->description = $request->description;
        
        if ($request->file('file_path')) {
            // File upload
            $file = $request->file('file_path');
            $fileName = $file->getClientOriginalName();
            $file->move('astronomical-3d-models', $fileName);

            $astronomicalObject->file_path = 'astronomical-3d-models/'.$fileName;
        }
 
        $astronomicalObject->save();

        return $astronomicalObject;
    }

    public function updateAstronomicalObject(Request $request, $id)
    {
        // Update astronomical object
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

        return $astronomicalObject;
    }

}