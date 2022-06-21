<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\AvailableSpaceflight;

class AvailableSpaceflightService {

    public function createAvailableSpaceflight(Request $request)
    {
        $availableSpaceflight = new AvailableSpaceflight();
        $availableSpaceflight->astronomical_object_id = $request->astronomical_object;
        $availableSpaceflight->spacecraft_id = $request->spacecraft;
        $availableSpaceflight->save();

        return $availableSpaceflight;
    }

    public function updateAvailableSpaceflight(Request $request, $id)
    {
        $availableSpaceflight = AvailableSpaceflight::findOrFail($id);
        $availableSpaceflight->astronomical_object_id = $request->astronomical_object;
        $availableSpaceflight->spacecraft_id = $request->spacecraft;
        $availableSpaceflight->save();

        return $availableSpaceflight;
    }

    public function deleteAvailableSpaceflight($id)
    {
        $availableSpaceflight = AvailableSpaceflight::findOrFail($id);

        $availableSpaceflight->delete();
    }

}