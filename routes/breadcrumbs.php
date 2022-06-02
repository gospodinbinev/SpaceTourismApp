<?php // routes/breadcrumbs.php

use App\Models\AstronomicalObject;
use App\Models\Role;
use App\Models\Spacecraft;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home\Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > Spacecraft
Breadcrumbs::for('spacecraft-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Spacecraft', route('spacecraft-list'));
});

// Home > Astronomical Object > [Object]
Breadcrumbs::for('show_astro_object', function (BreadcrumbTrail $trail, AstronomicalObject $astronomicalObject) {
    $trail->parent('dashboard');
    $trail->push($astronomicalObject->object_id, route('show_astro_object', $astronomicalObject));
});






// Home > [admin] Manage Roles 
Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Roles', route('roles.index'));
});

// Home > [admin] Create Role 
Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('roles.index');
    $trail->push('Create Role', route('roles.create'));
});

// Home > [admin] Edit Role 
Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('roles.index');
    $trail->push($role->name, route('roles.edit', $role));
});

// Home > [admin] Manage Astronomical Objects 
Breadcrumbs::for('astronomical-objects.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Astronomical Objects', route('astronomical-objects.index'));
});

// Home > [admin] Create Astronomical Object
Breadcrumbs::for('astronomical-objects.create', function (BreadcrumbTrail $trail) {
    $trail->parent('astronomical-objects.index');
    $trail->push('Create Astronomical Object', route('astronomical-objects.create'));
});

// Home > [admin] Edit Astronomical Object
Breadcrumbs::for('astronomical-objects.edit', function (BreadcrumbTrail $trail, AstronomicalObject $astronomicalObject) {
    $trail->parent('astronomical-objects.index');
    $trail->push($astronomicalObject->object_id, route('astronomical-objects.edit', $astronomicalObject));
});

// Home > [admin] Manage Spacecraft 
Breadcrumbs::for('spacecraft.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Manage Spacecraft', route('spacecraft.index'));
});

// Home > [admin] Create Spacecraft 
Breadcrumbs::for('spacecraft.create', function (BreadcrumbTrail $trail) {
    $trail->parent('spacecraft.index');
    $trail->push('Create Spacecraft', route('spacecraft.create'));
});

// Home > [admin] Edit Spacecraft 
Breadcrumbs::for('spacecraft.edit', function (BreadcrumbTrail $trail, Spacecraft $spacecraft) {
    $trail->parent('spacecraft.index');
    $trail->push($spacecraft->name, route('spacecraft.edit', $spacecraft));
});