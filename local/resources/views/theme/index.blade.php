@extends('layouts.theme.app')
@section('content')
<style type="text/css">
    .mt10{margin-top: 10px !important;}
</style>
    @if(count($sliders) > 0)
    <section id="slider"><!--slider-->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($sliders as $k=>$slider)
                            <li data-target="#slider-carousel" data-slide-to="{{$k}}" @if($k==0) class="active" @endif></li>
                            @endforeach
                        </ol>
                        
                        <div class="carousel-inner">
                            @foreach($sliders as $k=>$slider)
                            <div class="item @if($k==0) active @endif">
                                <div class="col-sm-6">
                                    <h1>{{$slider->title}}</h1>
                                    <h2>{{$slider->sub_title}}</h2>
                                    <p>{!! $slider->description !!}</p>
                                    @if($slider->url)
                                    <a href="{{$slider->url}}" class="btn btn-default get">Get it now</a>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{asset('images/'.$slider->image)}}" class="girl img-responsive" alt="" />
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--/slider-->
    @include('theme.common.featured_category_box')
    @if(count($channels) > 0)
    <br><br>
    @foreach($channels as $channel)
    <section id="festival_product">
        <div class="container">
            <h2 class="title text-center mt10">{{$channel->title}}</h2>
            @if($channel->image != NULL)
            <div class="col-md-4">
                <a href="">
                    <img src="{{asset('images/'.$channel->image)}}" width="100%">
                </a>
            </div>
            <div class="col-md-8">
                    <div class="recommended_items"><!--recommended_items-->
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($channel->product as $k=>$product)
                                <div class="item @if($k==0) active @endif"> 
                                    @foreach($product as $p)  
                                    <div class="col-sm-4">
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
            </div>
            @else
             <div class="col-md-12">
                    <div class="recommended_items"><!--recommended_items-->
                        <div id="recommended-item1-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($channel->product as $k=>$product)
                                <div class="item @if($k==0) active @endif"> 
                                    @foreach($product as $p)  
                                    <div class="col-sm-4">
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
                             <a class="left recommended-item-control" href="#recommended-item1-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right recommended-item-control" href="#recommended-item1-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>          
                        </div>
                    </div><!--/recommended_items-->
            </div>
            @endif
        </div>
    </section>
    @endforeach
    @endif
    <br><br>
    <div class="clearfix"></div>
    <section>
        <div class="container">
            <div class="">
                <div class="col-md-12 padding-right">
                    @if(count($new_products) > 0)
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">New Items</h2>
                        @foreach($new_products as $product)
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset('images/'.$product->product_attachment->file_name)}}" alt="" />
                                            <h2>Rs {{$product->price}}</h2>
                                            <p>{{$product->title}}</p>
                                            <p>@include('/theme/common/rating_display', ['avg_rating' => \App\Models\Rating::avg_rate($product->id), 'product_id' => $product->id, 'type' => 'new_product'])</p>
                                            <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <!-- <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$56</h2>
                                                <p>{{$product->title}}</p>
                                                <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div> -->
                                </div>
                                @include('theme/common/wishlist_action', ['product' => $product->id])
                            </div>
                        </div>
                        @endforeach
                    </div><!--features_items-->

                    @endif
                    @if(count($featured_products) > 0)
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @foreach($featured_products as $product)
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset('images/'.$product->product_attachment->file_name)}}" alt="" />
                                            <h2>Rs {{$product->price}}</h2>
                                            <p>{{$product->title}}</p>
                                            <p>@include('/theme/common/rating_display', ['avg_rating' => \App\Models\Rating::avg_rate($product->id), 'product_id' => $product->id, 'type' => 'featured_product'])</p>
                                            <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <!-- <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$56</h2>
                                                <p>{{$product->title}}</p>
                                                <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div> -->
                                </div>
                                @include('theme/common/wishlist_action', ['product' => $product->id])
                            </div>
                        </div>
                        @endforeach
                    </div><!--features_items-->
                    @endif
                    
                    @if(count($featured_categories) > 0)
                    <div class="category-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                @foreach($featured_categories as $k=>$category)
                                <li @if($k==0) class="active" @endif><a href="#category{{$category->id}}" data-toggle="tab">{{$category->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-content">
                            @foreach($featured_categories as $k=>$category)
                            <div class="tab-pane fade @if($k==0) active @endif in" id="category{{$category->id}}">
                                @foreach($category->product as $product)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{asset('images/'.$product->product_attachment->file_name)}}" alt="" />
                                                <h2>Rs. {{$product->price}}</h2>
                                                <p>{{$product->title}}</p>
                                                <p>@include('/theme/common/rating_display', ['avg_rating' => \App\Models\Rating::avg_rate($product->id), 'product_id' => $product->id, 'type' => 'category_product'])</p>
                                                <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                        @include('theme/common/wishlist_action', ['product' => $product->id])
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div><!--/category-tab-->
                    @endif
                    @if(count($recomended_products) > 0)
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>
                        
                        <div id="recommended-item-carousel123" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($recomended_products as $k=>$product)
                                <div class="item @if($k==0) active @endif"> 
                                    @foreach($product as $p)  
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset('images/'.\App\Models\Product::getAttachmentFromId($p['id']))}}" alt="" />
                                                    <h2>{{$p['price']}}</h2>
                                                    <p>{{$p['title']}}</p>
                                                    <p>@include('/theme/common/rating_display', ['avg_rating' => \App\Models\Rating::avg_rate($p['id']), 'product_id' => $p['id'], 'type' => 'recomended_two_product'])</p>
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
                             <a class="left recommended-item-control" href="#recommended-item-carousel123" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right recommended-item-control" href="#recommended-item-carousel123" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>          
                        </div>
                    </div><!--/recommended_items-->
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection