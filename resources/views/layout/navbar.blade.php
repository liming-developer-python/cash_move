<header id="header-wrap">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
        <div class="container" style="font-size: 1vw;">
            <!-- Brand and toggle get grouped for better mobile display -->
            <a href="{{ url('/') }}" class="navbar-brand">地域通貨</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="lni-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto w-100 justify-content-end clearfix">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            ホーム
                        </a>
                    </li>
                    @if(Auth::user())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/my-account') }}">
                                私の口座
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/profile') }}">
                                プロフィール
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/logout') }}">
                                ログアウト
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">
                                ログイン
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register') }}">
                                登録
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->
</header>
