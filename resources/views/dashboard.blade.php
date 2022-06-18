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

<div class="container-fluid" style="margin-top: 15px;">

    {{ Breadcrumbs::render('dashboard') }}

</div>

<div class="container-fluid" style="margin-top: 30px;">
    <h1 class="create-acc-label">Main planets in the Milky Way</h1>

    <div class="row">
        @foreach ($planets as $planet)
        <div class="col-md-3" style="margin-top: 20px;">
            <a style="text-decoration: none;" href="{{ route('show_astro_object', $planet->object_id) }}">
                <h1 class="dashboard-planets-label">
                    {{ $planet->object_id }} 

                    @if ($planet->object_id == 'Earth')
                        <span class="badge rounded-pill bg-primary"><i class="fa-solid fa-house"></i> Our home planet</span> 
                    @endif
                </h1>
            </a>

            <p class="planet-short-info">
                Semimajor Axis: {{ number_format($planet->solarSystemApi()->semimajorAxis, 0, '', ',') }} km <br> 
                Perihelion: {{ number_format($planet->solarSystemApi()->perihelion, 0, '', ',') }} km <br> 
                Aphelion: {{ number_format($planet->solarSystemApi()->aphelion, 0, '', ',') }} km
            </p>

            <a style="text-decoration: none;" href="{{ route('show_astro_object', $planet->object_id) }}">
                <img class="img-fluid" src="@foreach ($planet->thumbnails as $thumbnail) {{ asset($thumbnail->image_path) }} @endforeach" alt="">
            </a>
        </div>
        @endforeach
    </div>

</div>

@endsection
