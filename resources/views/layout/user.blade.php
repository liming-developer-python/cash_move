<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="msapplication-TileColor" content="#0061da">
    <meta name="theme-color" content="#1643a3">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <title>GNcoin</title>

    <link rel="stylesheet" href="{{asset('admin/fonts/fonts/font-awesome.min.css')}}">

    <!-- Font family -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">

    <!-- Dashboard Css -->
    <link href="{{asset('admin/css/dashboard.css')}}" rel="stylesheet" />

    <!-- c3.js Charts Plugin -->
    <link href="{{asset('admin/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet" />

    <!-- Custom scroll bar css-->
    <link href="{{asset('admin/plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

    <!-- Sidemenu Css -->
    <link href="{{asset('admin/plugins/toggle-sidebar/css/sidemenu.css')}}" rel="stylesheet">

    <!---Font icons-->
    <link href="{{asset('admin/plugins/iconfonts/plugin.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/line-icons.css') }}">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">

    <!-- Animate -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- Responsive Style -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    <link rel="icon" href="{{ asset('img/logo.jpg') }}" type="image/icon type">
    @yield('page-css')
</head>
<body>

<!-- Header Area wrapper Starts -->
@include('layout.navbar')
<!-- Header Area wrapper End -->

@yield('content')

<!-- Footer Section Start -->
{{--@include('layout.footer')--}}

<!-- Footer Section End -->

<!-- Go to Top Link -->
<a href="#" class="back-to-top">
    <i class="lni-arrow-up"></i>
</a>

<!-- Preloader -->
<div id="preloader">
    <div class="loader" id="loader-1"></div>
</div>
<!-- End Preloader -->

<script src="{{asset('admin/js/vendors/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('admin/js/vendors/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/js/vendors/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('admin/js/vendors/selectize.min.js')}}"></script>
<script src="{{asset('admin/js/vendors/jquery.tablesorter.min.js')}}"></script>
<script src="{{asset('admin/js/vendors/circle-progress.min.js')}}"></script>
<script src="{{asset('admin/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{ asset('js/jquery-min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/jquery.nav.js') }}"></script>
<script src="{{ asset('js/scrolling-nav.js') }}"></script>
{{--<script src="{{ asset('js/jquery.easing.min.js') }}"></script>--}}
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/form-validator.min.js') }}"></script>
<script src="{{ asset('js/contact-form-script.min.js') }}"></script>
<!-- Fullside-menu Js-->
<script src="{{asset('admin/plugins/toggle-sidebar/js/sidemenu.js')}}"></script>

<!--Time Counter -->
<script src="{{asset('admin/plugins/counters/jquery.missofis-countdown.js')}}"></script>
<script src="{{asset('admin/plugins/counters/counter.js')}}"></script>

<!--Counters -->
<script src="{{asset('admin/plugins/counters/counterup.min.js')}}"></script>
<script src="{{asset('admin/plugins/counters/waypoints.min.js')}}"></script>
<!-- Custom scroll bar Js-->
<script src="{{asset('admin/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

<!-- Custom Js-->
<script src="{{asset('admin/js/custom.js')}}"></script>
@yield('page-js')
</body>
</html>

