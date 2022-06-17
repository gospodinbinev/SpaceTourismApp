<?php

namespace App\Services;

use App\Models\UserAdditionalInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class UserService {

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $userAdditionalInfo = UserAdditionalInfo::where('user_id', $id)->first();

        // Profile pic
        if ($request->file('image_path')) {

            // Delete the old thumbnail for the current object
            foreach ($user->thumbnails as $currentThumb) {
                // If this is the default avatar in the system, dont delete it
                if ($currentThumb->image_path != "users/avatars/default/user.png") {
                    $deleteOldThumb = public_path($currentThumb->image_path);
                
                    File::delete($deleteOldThumb);
                }
            }

            // Thumbnail upload
            $originalImage = $request->file('image_path');
            $image = Image::make($originalImage);
            $image->orientate()->fit(250, 250, function ($constraint) {
                $constraint->upsize();
            });

            $imagePath = public_path().'/users/avatars/';
            $imageSaveName = time().$originalImage->getClientOriginalName();
            $image->save($imagePath.$imageSaveName);

            // Save thumbnail path in db
            $thumbnail = $user->thumbnails()->where('imageable_id', $user->id)->first();
            $thumbnail->image_path = 'users/avatars/'.$imageSaveName;
            $thumbnail->save();

        }

        // Main Info
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        
        // Aditional Info
        $user->userAdditionalInfo()->update([
            'user_id' => $user->id,
            'about' => $request->about,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address_line' => $request->address_line
        ]);

        $user->save();

        return $user;
    }

}