<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name') }} - {{ config('app.sub_name') }}</title>
    <link href="{{asset('theme/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('theme/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('theme/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('theme/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('theme/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('theme/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('theme/css/responsive.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('images/'.\App\Models\Setting::getFavicon())}}">
    
</head>

<body>
@php($banner = \App\Models\Setting::getPageBanner())
    <style>
    .all-title-box, .contact-info-left {
            background-image: url('{{asset("images/".$banner)}}') !important;
        }
    </style>

    @include('layouts.theme.header')
    
    @yield('content')
    
    @include('layouts.theme.footer')