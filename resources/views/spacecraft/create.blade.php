@extends('layouts.spaceapp')

@section('subtitle')Create Spacecraft @endsection

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

<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">

                <h1 style="color: #FFF; font-size: 30px; text-shadow: 1px 1px 2px black;">Create Spacecraft</h1>


                {!! Form::open(['method' => 'post', 'action' => 'App\Http\Controllers\SpacecraftController@store', 'files' => true]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}

                    {!! Form::text('name', old('name'), ['class' => 'form-control '.($errors->has('name') ? 'is-invalid':'')]) !!}
                    
                    <div class="invalid-feedback">
                        @error('name') {{ $message }} @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    {!! Form::label('height', 'Height', ['class' => 'form-label']) !!}

                    {!! Form::number('height', old('height'), ['class' => 'form-control '.($errors->has('height') ? 'is-invalid':'')]) !!}
                    
                    <div class="invalid-feedback">
                        @error('height') {{ $message }} @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    {!! Form::label('diameter', 'Diameter', ['class' => 'form-label']) !!}

                    {!! Form::number('diameter', old('diameter'), ['class' => 'form-control '.($errors->has('diameter') ? 'is-invalid':'')]) !!}
                    
                    <div class="invalid-feedback">
                        @error('diameter') {{ $message }} @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    {!! Form::label('payload', 'Payload', ['class' => 'form-label']) !!}

                    {!! Form::text('payload', old('payload'), ['class' => 'form-control '.($errors->has('payload') ? 'is-invalid':'')]) !!}
                    
                    <div class="invalid-feedback">
                        @error('payload') {{ $message }} @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    {!! Form::label('image', 'png or jpg Image', ['class' => 'form-label']) !!}

                    {!! Form::file('image', ['class' => 'form-control '.($errors->has('image') ? 'is-invalid':'')]) !!}

                    <div class="invalid-feedback">
                        @error('image') {{ $message }} @enderror
                    </div>

                </div>

                <button style="width: 100%; text-transform: uppercase; border-radius: 0; margin-top: 30px;" class="btn btn-primary">Create</button>

                {!! Form::close() !!}

                <p style="margin-top: 30px; text-align: left;">
                    <a class="link-light" style="font-weight: 300; text-shadow: 1px 1px 2px black;" href="{{ route('spacecraft.index') }}">Back to Spacecraft List</a>
                </p>

        </div>
    </div>
</section>

@endsection