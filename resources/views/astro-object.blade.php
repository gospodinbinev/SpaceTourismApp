@extends('layouts.spaceapp')

@section('subtitle'){{ $astronomicalObject->object_id }} @endsection

@section('content')

@section('onpage-css')
<style>
    model-viewer.reveal {
        --poster-color: transparent;

    }
    model-viewer {
        --progress-bar-color: transparent;
        width: 100%;
        height: 500px;
    }

    .sign-up-in-holder {
        margin-top: 30px;
        text-align: left;
    }

    .create-acc-label {
        font-size: 29px;
        color: #FFF;
        text-shadow: 1px 1px 2px black;
    }

    .dashboard-planets-label {
        font-size: 24px;
        font-weight: 300;
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

    .planet-short-info {
        color: #FFF; text-shadow: 1px 1px 2px black; 
        font-size: 16px; font-weight: 300;
    }
</style>
@endsection

@include('components.spaceapp-components.navigation')

<div class="container-fluid" style="margin-top: 30px;">
    
    <div class="row">

        <div class="col-md-4">
            
            <h1 class="create-acc-label">Information</h1>

            <p class="planet-short-info" style="background: #0D6EFD; padding: 10px; opacity: 0.9;">
                {{ $astronomicalObject->description }}
            </p>
            

            <p class="planet-short-info" style="background: #0D6EFD; padding: 10px; opacity: 0.9;">
                Semimajor Axis: <span style="float: right;">{{ number_format($astronomicalObject->semimajorAxis, 0, '', ',') }} km</span><br>

                Perihelion: <span style="float: right;">{{ number_format($astronomicalObject->perihelion, 0, '', ',') }} km</span><br>
                
                Aphelion: <span style="float: right;">{{ number_format($astronomicalObject->aphelion, 0, '', ',') }} km</span> <br>
                
                Orbital eccentricity: <span style="float: right;">{{ $astronomicalObject->eccentricity }}</span> <br>
                
                Orbital inclination in degrees: <span style="float: right;">{{ $astronomicalObject->inclination }}</span> <br>
                
                Body mass in 10<sup>n</sup> kg: <span style="float: right;">{{ $astronomicalObject->massValue }}</span> <br>
                
                Gravity: <span style="float: right;">{{ $astronomicalObject->gravity }} m/s<sup>2</sup></span><br>
                
                Radius: <span style="float: right;">{{ $astronomicalObject->meanRadius }} km</span><br>
                
                Length of the day: <span style="float: right;">{{ $astronomicalObject->sideralRotation }}</span><br>
                
                Average tempature in Celsius: <span style="float: right;">{{ $astronomicalObject->avgTemp }}°C</span><br>
                
                Axial tilt: <span style="float: right;">{{ $astronomicalObject->axialTilt }}</span>
            </p>

        </div>

        <div class="col-md-8">
            
            <h1 class="create-acc-label">{{ $astronomicalObject->object_id }}</h1>
            <p class="planet-short-info">
                Body type: {{ $astronomicalObject->bodyType }}
            </p>
            
            <!-- 3D object -->
            <!-- This inserts the 3D object inside the aside container -->
            <model-viewer class="reveal" loading="auto" src="{{ asset($astronomicalObject->file_path) }}" alt="{{ $astronomicalObject->object_id }}" auto-rotate camera-controls ar ios-src="{{ asset($astronomicalObject->file_path) }}"></model-viewer>

        </div>

    </div>

</div>

@endsection

@section('add-js')

<!--Imports a model-viewer JavaScript code -->
<!--It helps to handle how the 3D Object would be displayed -->
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>

@endsection