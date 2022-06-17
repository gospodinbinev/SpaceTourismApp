<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;
use App\Http\Requests\UpdateUserInfoRequest;

use MenaraSolutions\Geographer\Earth;
use MenaraSolutions\Geographer\Country;
use MenaraSolutions\Geographer\State;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewProfile()
    {
        $user = Auth::user();

        $userCountry = '';
        if (isset($user->userAdditionalInfo->country) && !is_null($user->userAdditionalInfo->country)) {
            $userCountry = Country::build($user->userAdditionalInfo->country);
        }

        return view('users.view', compact('user', 'userCountry'));
    }

    public function editUser()
    {
        $user = Auth::user();

        // Default entry point is our beautiful planet
        $earth = new Earth();

        $countries = [];
        // Give me a list of all countries please
        $takeAllCountries = $earth->getCountries()->toArray();

        foreach ($takeAllCountries as $country) {
            $countries[$country['code']] = $country['name'];
        }

        $selectedState = [];
        // If the user has already selected a state
        if (!is_null($user->userAdditionalInfo->state)) {
            $state = State::build($user->userAdditionalInfo->state);
            $selectedState = [$state->code => $state->name];
        }

        return view('users.edit', compact('user', 'countries', 'selectedState'));
    }

    public function searchStates(Request $request)
    {
        if ($request->ajax()) {

            $earth = new Earth();
            $country = $earth->getCountries()->findOne(['code' => $request->country_id]);
            $states = $country->getStates()->toArray();
            
            return Response($states);
        }
    }

    public function updateUser(UpdateUserInfoRequest $request, UserService $userService)
    {
        $user = $userService->updateUser($request, Auth::user()->id);

        return redirect()->route('edit-user')->withSuccess('Your profile has been updated successfully!');
    }


}
