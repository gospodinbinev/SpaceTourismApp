@extends('layouts.spaceapp')

@section('subtitle')Edit Role @endsection

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

    {{ Breadcrumbs::render('roles.edit', $role) }}

</div>

<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">

                <h1 style="color: #FFF; font-size: 30px; text-shadow: 1px 1px 2px black;">Edit Role</h1>



                {!! Form::open(['method' => 'PATCH', 'action' => ['App\Http\Controllers\RoleController@update', $role->id]]) !!}

                {!! Form::label('name', 'Role', ['class' => 'form-label']) !!}
                {!! Form::text('name', $role->name, ['class' => 'form-control '.($errors->has('name') ? 'is-invalid':'')]) !!}

                <div class="invalid-feedback">
                    @error('name') {{ $message }} @enderror
                </div>

                <button style="width: 100%; text-transform: uppercase; border-radius: 0; margin-top: 30px;" class="btn btn-primary">Update</button>

                {!! Form::close() !!}



                {!! Form::open(['method' => 'DELETE', 'action' => ['App\Http\Controllers\RoleController@destroy', $role->id]]) !!}

                <button style="float: right; text-transform: uppercase; border-radius: 0; margin-top: 20px;" class="btn btn-danger">Delete Role</button>

                {!! Form::close() !!}

                <p style="margin-top: 30px; text-align: left;">
                    <a class="link-light" style="font-weight: 300; text-shadow: 1px 1px 2px black;" href="{{ route('roles.index') }}">Back to Roles List</a>
                </p>

        </div>
    </div>
</section>

@endsection