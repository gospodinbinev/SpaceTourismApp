@extends('layouts.spaceapp')

@section('subtitle')Edit Available Spaceflight @endsection

@section('onpage-css')
<style>
    .sign-up-in-holder {
        margin-top: 30px;
        text-align: left;
    }

    .create-acc-label {
        font-size: 29px;
        color: #FFF;
        text-shadow: 1px 1px 2px black;
    }

    label {
        color: #FFF;
    }

    .form-control {
        padding: 0.1rem 0.75rem;
        border-radius: 0;
        font-weight: 300;
        opacity: 0.7;
    }

    .form-label {
        float: left;
        font-weight: 300;
        text-shadow: 1px 1px 2px black;
    }

    .invalid-feedback {
        text-shadow: 1px 1px 2px black;
        text-align: left;
    }

    .form-check-label {
        font-size: 15px;
        font-weight: 300;
        text-shadow: 1px 1px 2px black;
    }

    .form-check-input {
        border-radius: 0;
        opacity: 0.7;
    }

    .agreement-error {
        font-size: .875em;
        color: #dc3545;
        text-shadow: 1px 1px 2px black;
    }
</style>
@endsection

@section('content')

@include('components.spaceapp-components.navigation')

<div class="container-fluid" style="margin-top: 15px;">

    {{ Breadcrumbs::render('available-spaceflights.edit', $availableSpaceflight) }}

</div>

<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">

                <h1 style="color: #FFF; font-size: 30px; text-shadow: 1px 1px 2px black;">Edit Available Spaceflight</h1>

                {!! Form::open(['method' => 'PATCH', 'action' => ['App\Http\Controllers\AvailableSpaceflightsController@update', $availableSpaceflight->id]]) !!}

                <div class="form-group" style="margin-top: 15px;">
                    {!! Form::label('astronomical_object', 'Astronomical Object', ['class' => 'form-label']) !!}
    
                    {!! Form::select('astronomical_object', $formattedAstronomicalObjects, $availableSpaceflight->astronomical_object_id, ['placeholder' => 'Choose an astro object', 'class' => 'form-control '.($errors->has('astronomical_object') ? 'is-invalid':'')]) !!}
                
                    <div class="invalid-feedback">
                        @error('astronomical_object') {{ $message }} @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    {!! Form::label('spacecraft', 'Spacecraft', ['class' => 'form-label']) !!}
    
                    {!! Form::select('spacecraft', $formattedSpacecraft, $availableSpaceflight->spacecraft_id, ['placeholder' => 'Choose a spacecraft', 'class' => 'form-control '.($errors->has('spacecraft') ? 'is-invalid':'')]) !!}
                
                    <div class="invalid-feedback">
                        @error('spacecraft') {{ $message }} @enderror
                    </div>
                </div>

                <button style="width: 100%; text-transform: uppercase; border-radius: 0; margin-top: 30px;" class="btn btn-primary">Update</button>

                {!! Form::close() !!}

                {!! Form::open(['method' => 'DELETE', 'action' => ['App\Http\Controllers\AvailableSpaceflightsController@destroy', $availableSpaceflight->id]]) !!}

                <button style="float: right; text-transform: uppercase; border-radius: 0; margin-top: 20px;" class="btn btn-danger">Delete Spaceflight</button>

                {!! Form::close() !!}

                <p style="margin-top: 30px; text-align: left;">
                    <a class="link-light" style="font-weight: 300; text-shadow: 1px 1px 2px black;" href="{{ route('available-spaceflights.index') }}">Back to Available Spaceflights List</a>
                </p>

        </div>
    </div>
</section>

@endsection