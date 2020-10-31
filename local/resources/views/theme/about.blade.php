@extends('layouts.theme.app')
@section('content')

    <!-- Start About Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="{{url('/')}}">Home</a></li>
                  <li class="active">Page</li>
                </ol>
            </div>
            <div class="row">
				<div class="col-lg-6">
                    <div class="banner-frame"> <img class="img-fluid" src="{{asset('theme/images/about-img.jpg')}}" width="100%" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="noo-sh-title-top"><span>{{$page->title}}</span></h2>
                    <p>{!! $page->description !!}</p>
                </div>
            </div>
        </div>
    </div>

@endsection