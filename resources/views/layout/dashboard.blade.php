<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="msapplication-TileColor" content="#0670f0">
    <meta name="theme-color" content="#1643a3">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="{{ asset('img/logo.jpg') }}" type="image/icon type">

    <!-- Title -->
    <title>地域通貨</title>
    <link rel="stylesheet" href="{{asset('admin/fonts/fonts/font-awesome.min.css')}}">

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">

    <!-- Dashboard Css -->
    <link href="{{asset('admin/css/dashboard.css')}}" rel="stylesheet" />

    <!-- c3.js Charts Plugin -->
    <link href="{{asset('admin/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet" />

    <!-- Data table css -->
    <link href="{{asset('admin/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />

    <!-- Slect2 css -->
    <link href="{{asset('admin/plugins/select2/select2.min.css')}}" rel="stylesheet" />

    <!-- Custom scroll bar css-->
    <link href="{{asset('admin/plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

    <!-- Sidemenu Css -->
    <link href="{{asset('admin/plugins/toggle-sidebar/css/sidemenu.css')}}" rel="stylesheet">

    <!---Font icons-->
    <link href="{{asset('admin/plugins/iconfonts/plugin.css')}}" rel="stylesheet" />
</head>
<body class="app sidebar-mini rtl">
<div id="global-loader" ></div>
<div class="page">
    <div class="page-main">
        <!-- Navbar-->
        <header class="app-header header">

            <!-- Sidebar toggle button-->
            <!-- Navbar Right Menu-->
            <div class="container-fluid">
                <div class="d-flex">
                    <a class="header-brand" href="">
                        <span style="color: white;">ダッシュボード</span>
{{--                        <img alt="vobilet logo" class="header-brand-img" src="{{asset('admin/images/brand/logo.png')}}">--}}
                    </a>

                    <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>

                    <div class="d-flex order-lg-2 ml-auto">

                        <div class="dropdown">
                            <a class="nav-link pr-0 leading-none d-flex" data-toggle="dropdown" href="#">
                                <span class="avatar avatar-md brround" style="background-image: url({{asset('admin/images/contrast.svg')}})"></span>
                                <span class="ml-2 d-none d-lg-block">
                                    <span class="text-white">管理者</span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="{{url('/')}}"><i class="dropdown-icon mdi mdi-home-circle"></i> ホーム</a>
                                <a class="dropdown-item" href="{{url('/logout')}}"><i class="dropdown-icon mdi mdi-logout"></i> ログアウト</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar ">
            <ul class="side-menu">
                <li>
                    <a class="side-menu__item" href="{{url('/admin/dash')}}"><i class="side-menu__icon fa fa-user-circle"></i><span class="side-menu__label">使用者</span></a>
                </li>
                <li>
                    <a class="side-menu__item" href="{{url('/admin/account')}}"><i class="side-menu__icon fa fa-bank"></i><span class="side-menu__label">口座</span></a>
                </li>
                <li>
                    <a class="side-menu__item" href="{{url('/admin/history')}}"><i class="side-menu__icon fa fa-area-chart"></i><span class="side-menu__label">移送履歴</span></a>
                </li>
                <li>
                    <a class="side-menu__item" href="{{url('/admin/group')}}"><i class="side-menu__icon fa fa-group"></i><span class="side-menu__label">グループ</span></a>
                </li>
            </ul>
        </aside>
        @yield('content')

        <!--footer-->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-12 col-sm-12 mt-3 mt-lg-0 text-center">
                        Copyright © 2021. Designed by <a href="">MSL TEAM</a> All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->
    </div>
    <!--Back to top-->
    <a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>
    <script src="{{asset('admin/js/vendors/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('admin/js/vendors/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/js/vendors/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('admin/js/vendors/jquery.tablesorter.min.js')}}"></script>
    <script src="{{asset('admin/js/vendors/selectize.min.js')}}"></script>
    <script src="{{asset('admin/js/vendors/circle-progress.min.js')}}"></script>
    <script src="{{asset('admin/plugins/rating/jquery.rating-stars.js')}}"></script>

    <!-- Fullside-menu Js-->
    <script src="{{asset('admin/plugins/toggle-sidebar/js/sidemenu.js')}}"></script>


    <!-- Data tables -->
    <script src="{{asset('admin/plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Select2 js -->
    <script src="{{asset('admin/plugins/select2/select2.full.min.js')}}"></script>

    <!-- Custom scroll bar Js-->
    <script src="{{asset('admin/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

    <!-- Custom Js-->
    <script src="{{asset('admin/js/custom.js')}}"></script>

    <!-- Data table js -->
    <script>
        $(function(e) {
            $('#example').DataTable();
        } );
    </script>
    @yield('page-js')
</div>

</body>
</html>
