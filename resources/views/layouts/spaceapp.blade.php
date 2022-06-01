<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('subtitle')- {{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/stars.css') }}">

    @yield('onpage-css')

</head>
<body>

    <!-- particles.js container --> 
    <div id="particles-js"></div>

    @yield('content')

    <!-- particles.js lib - https://github.com/VincentGarreau/particles.js -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> 
    <script src="{{ asset('js/particles.min.js') }}"></script>
    <script src="{{ asset('js/stars.js') }}"></script>

    <script src="{{ asset('js/search.js') }}"></script>

    @yield('add-js')
    
</body>
</html>