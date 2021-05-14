 {{-- <!-- Meta Tag --> --}}
@yield('meta')
 {{--  <!-- Title Tag  --> --}}
<title>@yield('title')</title>
 {{--<!-- Favicon --> --}}
<link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}">
 {{--<!-- Web Font --> --}}
<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

 {{--<!-- StyleSheet --> --}}
<link rel="manifest" href="/manifest.json">
{{--<!-- Bootstrap -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
{{--<!-- Magnific Popup -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.min.css')}}">
{{--<!-- Font Awesome -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.css')}}">
{{--<!-- Fancybox -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/jquery.fancybox.min.css')}}">
{{--<!-- Themify Icons -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
{{--<!-- Nice Select CSS -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/niceselect.css')}}">
{{--<!-- Animate CSS -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
{{--<!-- Flex Slider CSS -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/flex-slider.min.css')}}">
{{--<!-- Owl Carousel -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/owl-carousel.css')}}">
{{--<!-- Slicknav -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/slicknav.min.css')}}">
{{--<!-- Jquery Ui -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.css')}}">

{{--<!-- Category Slide -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/category-slide.css')}}">
{{--<!-- Eshop StyleSheet -->--}}
<link rel="stylesheet" href="{{asset('frontend/css/reset.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">

<link rel="stylesheet" href="{{asset('frontend/css/categorylist.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
<link rel="stylesheet" href="{{asset('frontend/slick/slick.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/bottomnavigationbar.css')}}">
<link rel="stylesheet" href="{{asset('frontend/material-icon/material-icons.css')}}">
<style>
    /* Multilevel dropdown */
    .dropdown-submenu {
    position: relative;
    }

    .dropdown-submenu>a:after {
    content: "\f0da";
    float: right;
    border: none;
    font-family: 'FontAwesome';
    }

    .dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: 0px;
    margin-left: 0px;
    }


</style>

@if($agent->isMobile())
<style>
.l-flex-child {
    height: 100vh;
    overflow: auto;
	padding-bottom:80px;
}
.l-flex-child-2 {
    height: 100vh;
    overflow: auto;
	padding-bottom:80px;
}
</style>
@endif
@stack('styles')
