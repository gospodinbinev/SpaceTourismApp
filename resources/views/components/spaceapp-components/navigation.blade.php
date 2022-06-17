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
                    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                    </svg>
                    Manage

                </a>
                
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a></li>
                    <li><a class="dropdown-item" href="{{ route('astronomical-objects.index') }}">Astronomical Objects</a></li>
                    <li><a class="dropdown-item" href="{{ route('spacecraft.index') }}">Spacecraft</a></li>
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