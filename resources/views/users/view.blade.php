@extends('layouts.spaceapp')

@section('subtitle'){{$user->first_name.' '.$user->last_name}} @endsection

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

    {{ Breadcrumbs::render('view-profile') }}

</div>

<section class="text-center container">
    <div class="row py-lg">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="row">
                <div class="col-7">
                    <h1 class="profile-upper-left">
                        <img class="profile-pic" height="150" src="@foreach ($user->thumbnails as $thumbnail) {{ asset($thumbnail->image_path) }} @endforeach" alt=""> 
                        <br><br>
                        {{ $user->first_name.' '.$user->last_name }}
                    </h1>
                    <div class="clearfix"></div>
                    <span style="float: left;" class="badge bg-info text-dark">@username</span><br>
                    @if ($userCountry)
                        <span style="float: left; color: #fff;"><i class="fa-solid fa-location-dot"></i> {{ $userCountry->name }}</span>
                    @endif
                </div>
                <div class="col-5">
                    <a class="btn btn-light" style="float: right;" href="{{ route('edit-user', $user->id) }}">Edit profile</a>
                </div>
            </div>

            @if ($user->userAdditionalInfo->about)
                <div class="row" style="margin-top: 25px;">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="text-align: left;">
                                About
                            </div>
                            <div class="card-body">
                                <p class="card-text" style="text-align: left;">{{ $user->userAdditionalInfo->about }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</section>

@endsection
