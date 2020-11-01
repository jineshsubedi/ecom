@extends('layouts.theme.app')
@section('content')

<!-- Start Shop Page  -->
@include('theme/common/header_banner', ['title' => $data['group']->title, 'description' => $data['group']->description, 'image' => $data['group']->image])
<style>
    body{
        background-color: #eaeaea;
    }
</style>

<div class="container">
    <div class="row">
        @foreach($data['category'] as $category)
        <h3>
            <a href="{{url('shop?filter_category='.$category->slug)}}">{{$category->title}}</a>
            @if($category->featured == 1)
                <span class="badge bg-blue">Featured</span>
            @endif
        </h3>
        <section id="{{$category->slug}}">
            <div class="box" style="border: 1px solid #d2d2ff;padding: 10px;margin-bottom: 10px;background-color: #f7f7f7;">
                <div class="box-body">
                    <div class="box-header">
                        
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            @if($category->image != NULL)
                            <img src="{{asset('images/'.$category->image)}}" style="width: 100%;">
                            @else 
                            <img src="{{asset('theme/images/no-img.jpg')}}" style="width: 100%;">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                @foreach($category->total_sub_category as $sub_category)
                                <div class="col-md-4" style="height: 150px;">
                                    <a href="{{url('shop?filter_sub_category='.$category->slug)}}">
                                    <div class="well">
                                        {{$sub_category->title}}
                                    </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            @if(count($category->product) > 0)
                            <div class="recommended_items"><!--recommended_items-->
                                <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($category->product as $k=>$product)
                                        <div class="item @if($k==0) active @endif"> 
                                            @foreach($product as $p)  
                                            <div class="col-sm-3">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <img src="{{asset('images/'.\App\Models\Product::getAttachmentFromId($p['id']))}}" alt="" />
                                                            <h2>{{$p['price']}}</h2>
                                                            <p>{{$p['title']}}</p>
                                                            <p>@include('/theme/common/rating_display', ['avg_rating' => \App\Models\Rating::avg_rate($p['id']), 'product_id' => $p['id'], 'type' => 'recomended_product'])</p>
                                                            <a href="{{url('shop/'.$p['slug'])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                        </div>
                                                    </div>
                                                    @include('theme/common/wishlist_action', ['product' => $p['id']])
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                     <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                        <i class="fa fa-angle-left"></i>
                                      </a>
                                      <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                        <i class="fa fa-angle-right"></i>
                                      </a>          
                                </div>
                            </div><!--/recommended_items-->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endforeach
    </div>
</div>
@endsection
<!-- <div class="col-md-12">
            <section>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($category->image != NULL)
                            <img src="{{asset('images/'.$category->image)}}" style="width: 100%;">
                            @else 
                            <img src="{{asset('theme/images/no-img.jpg')}}" style="width: 100%;">
                            @endif
                        </div>
                        <div class="col-md-8">
                            
                        </div>
                    </div>
                   <h5 class="card-title"><a href="{{url('shop?filter_category='.$category->slug)}}">{{$category->title}}</a></h5>
                  <p><a href="{{url('shop?filter_category='.$category->slug)}}">Total Product: {{$category->total_product}}</a></p>
                  <p><a href="{{url('shop?filter_category='.$category->slug)}}">Categories: {{count($category->total_sub_category)}}</a></p>
                </div>
            </div>
            </section>
        </div>
 -->