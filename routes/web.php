<?php

use App\Http\Controllers\SolarSystemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AstronomicalObjectsController;
use App\Http\Controllers\SpacecraftController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Welcome page
Route::get('/', function () {

    if (!Auth::check()) {

        return view('welcome');
    
    }

    return redirect()->back();

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::controller(SolarSystemController::class)->group(function () {
    // Dashboard
    Route::get('/dashboard', 'dashboard')->name('dashboard');

    // Search for astronomical objects
    Route::get('/search', 'search');

    // Show an astronomical object
    Route::get('/astronomical-object/{object_id}', 'showAstronomicalObject')->name('show_astro_object');



    // Test API
    Route::get('/testapi', 'fetch');
});

// Manage Roles
Route::resource('roles', RoleController::class);

// Manage Astronomical Objects
Route::resource('astronomical-objects', AstronomicalObjectsController::class);

// Manage Spacecraft
Route::resource('spacecraft', SpacecraftController::class);

require __DIR__.'/auth.php';
