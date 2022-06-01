@extends('layouts.spaceapp')

@section('subtitle')Create Astronomical Object @endsection

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

                <h1 style="color: #FFF; font-size: 30px; text-shadow: 1px 1px 2px black;">Create Astronomical Object</h1>


                {!! Form::open(['method' => 'post', 'action' => 'App\Http\Controllers\AstronomicalObjectsController@store', 'files' => true]) !!}

                <div class="form-group">
                    {!! Form::label('object_id', 'Object', ['class' => 'form-label']) !!}

                    {!! Form::text('object_id', old('object_id'), ['class' => 'form-control '.($errors->has('object_id') ? 'is-invalid':'')]) !!}
                    
                    <div class="invalid-feedback">
                        @error('object_id') {{ $message }} @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}

                    {!! Form::textarea('description', old('description'), ['class' => 'form-control '.($errors->has('description') ? 'is-invalid':'')]) !!}
                    
                    <div class="invalid-feedback">
                        @error('description') {{ $message }} @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    {!! Form::label('file_path', 'glTF or gld File', ['class' => 'form-label']) !!}

                    {!! Form::file('file_path', ['class' => 'form-control '.($errors->has('file_path') ? 'is-invalid':'')]) !!}

                    <div class="invalid-feedback">
                        @error('file_path') {{ $message }} @enderror
                    </div>

                </div>

                <button style="width: 100%; text-transform: uppercase; border-radius: 0; margin-top: 30px;" class="btn btn-primary">Create</button>

                {!! Form::close() !!}

                <p style="margin-top: 30px; text-align: left;">
                    <a class="link-light" style="font-weight: 300; text-shadow: 1px 1px 2px black;" href="{{ route('astronomical-objects.index') }}">Back to Astronomical Objects List</a>
                </p>

        </div>
    </div>
</section>

@endsection