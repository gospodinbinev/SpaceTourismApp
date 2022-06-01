@extends('app')

@section('subtitle')Explore the space. Book space trips. Enjoy the future. @endsection

@section('content')

<p class="lead text-muted app-description">Explore the space. Book complete trips. Select your destination from the entire solar system. The all-in one space travel platform inspired by an idea of Elon Musk.</p>
<p>
    <a href="{{ route('register') }}" class="btn btn-primary my-2 app-register">Create account</a>
    <a href="{{ route('login') }}" class="btn btn-secondary my-2 app-login">Sign In</a>
</p>

@endsection