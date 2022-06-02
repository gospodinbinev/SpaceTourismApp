@extends('layouts.spaceapp')

@section('subtitle')Spacecraft @endsection

@section('content')

@section('onpage-css')
<style>
    model-viewer.reveal {
        --poster-color: transparent;

    }
    model-viewer {
        --progress-bar-color: transparent;
        width: 100%;
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
        font-size: 29px;
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
        font-weight: 300; color: #FFF; text-shadow: 1px 1px 2px black; font-size: 13px;
    }
</style>
@endsection

@include('components.spaceapp-components.navigation')

<div class="container-fluid" style="margin-top: 30px;">
    <h1 class="create-acc-label">Spaceships that you can book</h1>

    <div class="row">
        @foreach ($spacecraft as $machine)
        <div class="col-md-6" style="margin-top: 20px;">
            <a style="text-decoration: none;" href="#"><h1 class="dashboard-planets-label">{{ $machine->name }}</h1></a>

            <a style="text-decoration: none;" href="#">
                <img class="img-fluid" src="{{ asset($machine->image) }}" alt="">
            </a>
        </div>

        <div class="col-md-6">
            <h1 class="dashboard-planets-label">Height: <span style="float: right;">{{ $machine->height }} ft</span></h1>
            <h1 class="dashboard-planets-label">Diameter: <span style="float: right;">{{ $machine->diameter }} ft</span></h1>
            <h1 class="dashboard-planets-label">Payload: <span style="float: right;">{{ $machine->payload }}</span></h1>
        </div>
        @endforeach
    </div>

</div>

@endsection
