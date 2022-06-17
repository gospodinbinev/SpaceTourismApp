@extends('layouts.spaceapp')

@section('subtitle')Edit Profile @endsection

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

    {{ Breadcrumbs::render('edit-user', $user = Auth::user()) }}

</div>

<section class="text-center container">
    <div class="row py-lg">
        <div class="col-lg-6 col-md-8 mx-auto">
        
            <h1 style="color: #FFF; font-size: 30px; text-shadow: 1px 1px 2px black;">
                <img class="profile-pic" height="150" src="@foreach ($user->thumbnails as $thumbnail) {{ asset($thumbnail->image_path) }} @endforeach" alt=""> 
                <br>Edit Profile
            </h1>

            @if(Session::has('success'))
                <div class="alert alert-success" style="margin-top: 30px; border-radius: 0;">
                    {{Session::get('success')}}
                </div>
            @endif

            {!! Form::open(['method' => 'POST', 'action' => ['App\Http\Controllers\UserController@updateUser', $user->id], 'files' => true]) !!}

            <div class="form-group" style="margin-top: 15px;">
                {!! Form::label('image_path', 'Profile picture', ['class' => 'form-label']) !!}

                {!! Form::file('image_path', ['class' => 'form-control '.($errors->has('image_path') ? 'is-invalid':'')]) !!}

                <div class="invalid-feedback">
                    @error('image_path') {{ $message }} @enderror
                </div>

            </div>

            <div class="form-group" style="margin-top: 15px;">
                {!! Form::label('first_name', 'First name', ['class' => 'form-label']) !!}

                {!! Form::text('first_name', $user->first_name, ['class' => 'form-control '.($errors->has('first_name') ? 'is-invalid':'')]) !!}
                
                <div class="invalid-feedback">
                    @error('first_name') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                {!! Form::label('last_name', 'Last name', ['class' => 'form-label']) !!}

                {!! Form::text('last_name', $user->last_name, ['class' => 'form-control '.($errors->has('last_name') ? 'is-invalid':'')]) !!}
                
                <div class="invalid-feedback">
                    @error('last_name') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                {!! Form::label('about', 'Bio', ['class' => 'form-label']) !!}

                {!! Form::textarea('about', $user->userAdditionalInfo->about, ['class' => 'form-control '.($errors->has('about') ? 'is-invalid':'')]) !!}
                
                <div class="invalid-feedback">
                    @error('about') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                {!! Form::label('country', 'Country', ['class' => 'form-label']) !!}

                {!! Form::select('country', $countries, $user->userAdditionalInfo->country, ['placeholder' => 'Choose your country', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group" style="margin-top: 15px;">
                {!! Form::label('state', 'State', ['class' => 'form-label']) !!}

                {!! Form::select('state', $selectedState, $user->userAdditionalInfo->state, ['placeholder' => 'Choose your state', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group" style="margin-top: 15px;">
                {!! Form::label('city', 'City', ['class' => 'form-label']) !!}

                {!! Form::text('city', $user->userAdditionalInfo->city, ['class' => 'form-control '.($errors->has('city') ? 'is-invalid':'')]) !!}
                
                <div class="invalid-feedback">
                    @error('city') {{ $message }} @enderror
                </div>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                {!! Form::label('address_line', 'Address line', ['class' => 'form-label']) !!}

                {!! Form::text('address_line', $user->userAdditionalInfo->address_line, ['class' => 'form-control '.($errors->has('address_line') ? 'is-invalid':'')]) !!}
                
                <div class="invalid-feedback">
                    @error('address_line') {{ $message }} @enderror
                </div>
            </div>


            <button style="width: 100%; text-transform: uppercase; border-radius: 0; margin-top: 30px;" class="btn btn-primary">Update</button>

            {!! Form::close() !!}


            <p style="margin-top: 30px; text-align: left;">
                <a class="link-light" style="font-weight: 300; text-shadow: 1px 1px 2px black;" href="{{ route('dashboard') }}">Back to Home</a>
            </p>

        </div>
    </div>
</section>

@endsection

@section('add-js')
<script>
$(document).ready(function(){

    $('#country').on('change',function(e){
        var country_id = e.target.value;

        // ajax
        $.get('/country/state?country_id=' + country_id, function(data){
            //success data
            $('#state').empty();

            $.each(data, function(index, modelObj){
                $('#state').append('<option value="'+modelObj.code+'">'+modelObj.name+'</option>');
            });
        });
    });
});
</script>
@endsection