@extends('app')

@section('subtitle')Register @endsection

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
<div class="sign-up-in-holder">
<h3 class="mb-3 create-acc-label">Create Account</h3>

{!! Form::open(['method' => 'post', 'route' => 'register', 'novalidate']) !!}

<div class="row g-3">
<div class="col-sm-6">
    {!! Form::label('first_name', 'First name', ['class' => 'form-label']) !!}

    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control '.($errors->has('first_name') ? 'is-invalid':'')]) !!}
    
    <div class="invalid-feedback">
        @error('first_name') {{ $message }} @enderror
    </div>
</div>

<div class="col-sm-6">
    {!! Form::label('last_name', 'Last name', ['class' => 'form-label']) !!}

    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control '.($errors->has('last_name') ? 'is-invalid':'')]) !!}
    
    <div class="invalid-feedback">
        @error('last_name') {{ $message }} @enderror
    </div>
</div>
</div>

<div class="col-12" style="margin-top: 20px;">
    {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}

    {!! Form::text('email', old('email'), ['class' => 'form-control '.($errors->has('email') ? 'is-invalid':'')]) !!}
    
    <div class="invalid-feedback">
        @error('email') {{ $message }} @enderror
    </div>
</div>

<div class="row g-3" style="margin-top: 0;">
<div class="col-sm-6">
    {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}

    {!! Form::password('password', ['class' => 'form-control '.($errors->has('password') ? 'is-invalid':'')]) !!}
    
    <div class="invalid-feedback">
        @error('password') {{ $message }} @enderror
    </div>
</div>

<div class="col-sm-6">
    {!! Form::label('password_confirmation', 'Confirm password', ['class' => 'form-label']) !!}

    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}

</div>
</div>

<div class="col-12" style="margin-top: 20px;">
    <div class="form-check is-invalid">
        {!! Form::checkbox('agreement', 1, (old('agreement') ? true:false), ['class' => 'form-check-input']) !!}
        
        {!! Form::label('agreement', 'By creating a '.config('app.name').' Account, I understand and agree to '.config('app.name').'\'s <a class="link-info" href="#">Privacy Notice</a> and <a class="link-info" href="#">Terms of Use</a>', ['class' => 'form-check-label'], false) !!}
        
        <div class="agreement-error" style="">
            @error('agreement') {{ $message }} @enderror
        </div>
    </div>
</div>

<div class="col-12" style="margin-top: 20px;">
    <a class="link-light" style="font-weight: 300; text-decoration: none; text-shadow: 1px 1px 2px black;" href="{{ route('login') }}">Already registered?</a>
</div>

<div class="col-12" style="margin-top: 35px;">
    <button style="width: 100%; text-transform: uppercase; border-radius: 0;" class="btn btn-primary">Create Account</button>
</div>


{!! Form::close() !!}

</div>
@endsection