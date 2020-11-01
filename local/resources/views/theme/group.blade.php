@extends('layouts.theme.app')
@section('content')

<!-- Start Shop Page  -->
@include('theme/common/header_banner', ['title' => $data['group']->title, 'description' => $data['group']->description, 'image' => $data['group']->image])

<div class="container">
    <div class="row">
        @foreach($data['category'] as $category)
        <div class="col-md-4" style="border: 1px solid #909091; border-radius: 5px;">
            @if($category->image != NULL)
            <img src="{{asset('images/'.$category->image)}}" style="width: 360px; height: 200px; object-fit: contain;">
            @else 
            <img src="{{asset('theme/images/no-img.jpg')}}" style="width: 360px; height: 200px; object-fit: contain;">
            @endif
            <h3><a href="{{url('shop?filter_category='.$category->slug)}}">{{$category->title}}</a></h3>
            <p><a href="{{url('shop?filter_category='.$category->slug)}}">Total Product: {{$category->total_product}}</a></p>
            <p><u>shop with sub category:</u></p>
            <ul class="list-group">
                @foreach($category->total_sub_category as $sub)
                <a href="{{url('shop?filter_sub_category='.$sub->slug)}}"><li class="list-group-item">{{$sub->title}}</li></a>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
    
</div>

@endsection