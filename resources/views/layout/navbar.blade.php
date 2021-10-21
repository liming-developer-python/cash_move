<header id="header-wrap">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
        <div class="container" style="font-size: 1rem;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a href="{{ url('/') }}" class="navbar-brand">IIVIIET</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="lni-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto w-100 justify-content-end clearfix">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            Home
                        </a>
                    </li>
                    @if(Auth::user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/my-account') }}">
                                My accounts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/profile') }}">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/history') }}">
                                History
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/export') }}">
                                Export
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/logout') }}">
                                Logout
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register') }}">
                                Register
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
</header>
