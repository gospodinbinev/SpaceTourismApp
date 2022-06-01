@extends('app')

@section('subtitle')Forgot your password @endsection

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

    .form-check-label, {
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

    p {
        font-size: 15px; font-weight: 300; color: #FFF; text-shadow: 1px 1px 2px black;
    }

    .alert {
        font-size: 15px;
        opacity: 0.7;
        border-radius: 0;
    }
</style>
@endsection

@section('content')
<div class="sign-up-in-holder">
<h3 class="mb-3 create-acc-label">Reset password</h3>

<p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

{!! Form::open(['method' => 'post', 'route' => 'password.email', 'novalidate']) !!}

<div class="col-12" style="margin-top: 20px;">
    {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}

    {!! Form::text('email', old('email'), ['class' => 'form-control '.($errors->has('email') ? 'is-invalid':'')]) !!}
    
    <div class="invalid-feedback">
        @error('email') {{ $message }} @enderror
    </div>
</div>

<div class="col-12" style="margin-top: 35px;">
    <button style="width: 100%; text-transform: uppercase; border-radius: 0;" class="btn btn-primary">Send</button>
</div>


{!! Form::close() !!}

</div>
@endsection