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

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
        
            <div class="lines"></div>
            <h3>
                <span style="display: none;">SPACE</span>
                <span>SPACE</span>
            </h3>
            <h2>Tourism</h2>

            @yield('content')
            </div>
        </div>
    </section>

    <!-- particles.js lib - https://github.com/VincentGarreau/particles.js -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> 
    <script src="{{ asset('js/particles.min.js') }}"></script>
    <script src="{{ asset('js/stars.js') }}"></script>
    
</body>
</html>