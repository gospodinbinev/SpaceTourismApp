@extends('layouts.spaceapp')

@section('subtitle')Home @endsection

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
        font-weight: 300; color: #FFF; text-shadow: 1px 1px 2px black; font-size: 13px;
    }
</style>
@endsection

@include('components.spaceapp-components.navigation')

<div class="container-fluid" style="margin-top: 30px;">
    <h1 class="create-acc-label">Main planets you have to visit</h1>

    <div class="row">
        @foreach ($planets as $planet)
        <div class="col-md-3" style="margin-top: 20px;">
            <a style="text-decoration: none;" href="{{ route('show_astro_object', $planet->object_id) }}"><h1 class="dashboard-planets-label">{{ $planet->object_id }}</h1></a>
            <p class="planet-short-info">Semimajor Axis: {{ number_format($planet->semimajorAxis, 0, '', ',') }} km <br> Perihelion: {{ number_format($planet->perihelion, 0, '', ',') }} km <br> Aphelion: {{ number_format($planet->aphelion, 0, '', ',') }} km</p>

            <!-- 3D object -->
            <!-- This inserts the 3D object inside the aside container -->
            <a style="text-decoration: none;" href="{{ route('show_astro_object', $planet->object_id) }}">
                <model-viewer @if ($planet->object_id == 'saturn') min-field-of-view="90deg" @endif class="reveal" loading="auto" src="{{ asset($planet->file_path) }}" alt="{{ $planet->object_id }}" auto-rotate ar ios-src="{{ asset($planet->file_path) }}"></model-viewer>
            </a>
        </div>
        @endforeach
    </div>

</div>

@endsection

@section('add-js')

<!--Imports a model-viewer JavaScript code -->
<!--It helps to handle how the 3D Object would be displayed -->
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>

@endsection
