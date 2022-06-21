<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <!-- Navbar content -->
    <div class="container-fluid">

    <a class="navbar-brand" href="{{ route('dashboard') }}">
    
        <h3 style="font-size: 34px; text-align: center;">
            <span style="display: none;">SPACE</span>
            <span>SPACE</span>
        </h3>
        <h2 style="font-size: 28px; text-align: center;">Tourism</h2>

    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('spacecraft-list') }}">Spacecraft</a>
        </li>

        <!-- Admin menu -->
        @if (Auth::user()->isAdmin() == true)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    <i class="fa-solid fa-wrench"></i>
                    Manage

                </a>
                
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a></li>
                    <li><a class="dropdown-item" href="{{ route('astronomical-objects.index') }}">Astronomical Objects</a></li>
                    <li><a class="dropdown-item" href="{{ route('spacecraft.index') }}">Spacecraft</a></li>
                    <li><a class="dropdown-item" href="{{ route('available-spaceflights.index') }}">Available Spaceflights</a></li>
                </ul>
                
            </li>
        @endif
        
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="profile-pic" height="30" src="@foreach (Auth::user()->thumbnails as $thumbnail) {{ asset($thumbnail->image_path) }} @endforeach">
                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('view-profile') }}">My profile</a></li>
                <li>
                    {!! Form::open(['method' => 'post', 'route' => 'logout']) !!}
                    {!! Form::submit('Logout', ['class' => 'dropdown-item']) !!}
                    {!! Form::close() !!}
                </li>
            </ul>
        </li>
        </ul>

        <!-- Search form -->
        <div class="d-flex">
            <input class="search form-control me-2" name="search" id="search-form" type="text" placeholder="Search for space objects">
            <button class="search-btn btn btn-outline-light">Search</button>

            <ul class="dropdown-menu" id="search-result" aria-labelledby="search-form" style="margin-top: 40px;">
                
            </ul>
        </div>

    </div>
    </div>
</nav>