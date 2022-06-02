@extends('layouts.spaceapp')

@section('subtitle')Manage Spacecraft @endsection

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

    {{ Breadcrumbs::render('spacecraft.index') }}

</div>

<div class="container-fluid" style="margin-top: 30px;">
    <h1 style="color: #FFF; font-size: 30px; text-shadow: 1px 1px 2px black;">Manage Spacecraft</h1>
    <a class="btn btn-primary" href="{{ route('spacecraft.create') }}">Create Spacecraft</a>

    @if(Session::has('success'))
        <div class="alert alert-success" style="margin-top: 30px; border-radius: 0;">
            {{Session::get('success')}}
        </div>
    @endif

    <table class="table" style="color: #FFF;">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Created at</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($spacecraft as $machine)
          <tr>
            <th scope="row">{{ $machine->id }}</th>
            <td>{{ $machine->name }}</td>
            <td><img height="50" src="{{ asset($machine->image) }}" alt=""></td>
            <td>{{ $machine->created_at }}</td>
            <td><a class="btn btn-outline-info" href="{{ route('spacecraft.edit', $machine->id) }}">Edit</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>

</div>

@endsection