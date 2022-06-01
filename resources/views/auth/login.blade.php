@extends('app')

@section('subtitle')Sign In @endsection

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
<h3 class="mb-3 create-acc-label">Sign In</h3>

{!! Form::open(['method' => 'post', 'route' => 'login', 'novalidate']) !!}

<div class="col-12" style="margin-top: 20px;">
    {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}

    {!! Form::text('email', old('email'), ['class' => 'form-control '.($errors->has('email') ? 'is-invalid':'')]) !!}
    
    <div class="invalid-feedback">
        @error('email') {{ $message }} @enderror
    </div>
</div>

<div class="col-12" style="margin-top: 20px;">
    {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}

    {!! Form::password('password', ['class' => 'form-control '.($errors->has('password') ? 'is-invalid':'')]) !!}
    
    <div class="invalid-feedback">
        @error('password') {{ $message }} @enderror
    </div>
</div>


<div class="col-12" style="margin-top: 20px;">
    <div class="form-check is-invalid">
        {!! Form::checkbox('remember', 1, (old('remember') ? true:false), ['class' => 'form-check-input']) !!}
        
        {!! Form::label('remember', 'Remember me', ['class' => 'form-check-label']) !!}
    </div>
</div>

<div class="col-12" style="margin-top: 20px;">
    <a class="link-light" style="font-weight: 300; text-decoration: none; text-shadow: 1px 1px 2px black;" href="{{ route('password.request') }}">Forgot your password?</a>
</div>

<div class="col-12" style="margin-top: 35px;">
    <button style="width: 100%; text-transform: uppercase; border-radius: 0;" class="btn btn-primary">Login</button>
</div>


{!! Form::close() !!}

</div>
@endsection