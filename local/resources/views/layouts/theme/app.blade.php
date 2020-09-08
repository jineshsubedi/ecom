<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Site Metas -->
    <title>{{ config('app.name') }} - {{ config('app.sub_name') }}</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{asset('theme/images/favicon.png')}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('theme/images/apple-touch-icon.png')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('theme/css/bootstrap.min.css')}}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('theme/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('theme/css/responsive.css')}}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('theme/css/custom.css')}}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
@php($banner = \App\Models\Setting::getPageBanner())
<style>
    .all-title-box, .contact-info-left {
        background-image: url('{{asset("images/".$banner)}}') !important;
    }
</style>
    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <!-- <div class="custom-select-box">
                        <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                            <option>¥ JPY</option>
                            <option>$ USD</option>
                            <option>€ EUR</option>
                        </select>
                    </div> -->
                    <div class="right-phone-box">
                        <p>Call US :- <a href="tel:+9779848310476"> {{\App\Models\Setting::getMainPhone()}}</a></p>
                    </div>
                    <div class="our-link">
                        <ul>
                            @auth
                            <li><a href="{{route('profile', Auth::user()->id)}}"><i class="fa fa-user s_color"></i> My Account</a></li>
                            @endauth
                            <li><a href="{{\App\Models\Setting::getMap()}}" target="_blank"><i class="fas fa-location-arrow"></i> Our location</a></li>
                            <li><a href="{{url('/contact-us')}}"><i class="fas fa-headset"></i> Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="login-box">
                        @guest
                        <select id="basic_login" class="selectpicker form-control" data-placeholder="Sign In">
                            <option value="">Guest</option>
                            <option value="register">Register Here</option>
                            <option value="login">Sign In</option>
                        </select>
                        @endguest
                        @auth
                        <select id="basic_login" class="selectpicker form-control" data-placeholder="Sign In">
                            <option value="">{{Auth::user()->name}}</option>
                            <option value="home">Dashboard</option>
                            <option value="logout">Sign Out</option>
                        </select>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->
    @include('layouts.theme.header')
    @include('sweet::alert')
    @yield('content')
    @include('layouts.theme.footer')
    <script>
    $('#basic_login').change(function() {
        var type = $(this).val();
        if (type == 'register') {
            location = '{{route("register")}}'
        }
        if (type == 'login') {
            location = '{{route("login")}}'
        }
        if (type == 'home') {
            location = '{{route("home")}}'
        }
        if (type == 'logout') {
            $('#logout-form').submit();
        }
    })

    </script>
