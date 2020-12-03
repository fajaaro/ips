<div class="container-fluid navigation">
    <nav class="row navbar navbar-expand-lg navbar-dark">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('frontend/assets/logo-navbar.png') }}" alt="Indonesia Patisserie School" />
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ml-auto mr-3 d-flex align-items-center">
                <li class="nav-item mx-md-2">
                    <a href="{{ route('frontend.courses.index') }}" class="nav-link actived ">All Course</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="{{ route('frontend.courses.index') . '?type=bundle' }}" class="nav-link">Bundle</a>
                </li>
                <li class="nav-item mx-md-2">
                    <a href="dashboard.html" class="nav-link">

                        @if (Auth::user()->image)
                            <img src="{{ Storage::url(Auth::user()->image->url) }}" width="40" height="40" class="rounded-circle" alt="">
                        @else
                            <img src="{{ asset('frontend/assets/vector-user.svg') }}" width="40" height="40" class="rounded-circle" alt="">
                        @endif
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Hi, {{ Auth::user()->first_name }}</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('frontend.profiles.index') }}" class="dropdown-item" style="color: #000000 !important;">My Account</a>
                        <a href="{{ route('logout') }}" class="dropdown-item" style="color: #000000 !important;" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>