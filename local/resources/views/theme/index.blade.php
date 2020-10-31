@extends('layouts.theme.app')
@section('content')

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
    <br><br>
    <section id="festival_product">
        <div class="container" style="border: 1px solid #dcdcf7">
            <div class="col-md-4">
                <a href="">
                    <img src="https://cdnimg.webstaurantstore.com/images/home-page-carousels/c/c09493b4-d687-e1bb-1765abe48f7a24da.jpg" width="100%">
                </a>
            </div>
            <div class="col-md-8">

                @if(count($recomended_products) > 0)
                    <div class="recommended_items"><!--recommended_items-->
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($recomended_products as $k=>$product)
                                <div class="item @if($k==0) active @endif"> 
                                    @foreach($product as $p)  
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset('images/'.\App\Models\Product::getAttachmentFromId($p['id']))}}" alt="" />
                                                    <h2>{{$p['price']}}</h2>
                                                    <p>{{$p['title']}}</p>
                                                    <p>@include('/theme/common/rating_display', ['avg_rating' => \App\Models\Rating::avg_rate($p['id']), 'product_id' => $p['id']])</p>
                                                    <a href="{{url('shop/'.$p['slug'])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                            <div class="choose">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                </ul>
                                            </div>

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
    </section>
    <br><br>
    <div class="clearfix"></div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('theme.common.left_sidebar', ['categories' => $categories])
                </div>
                
                <div class="col-sm-9 padding-right">
                    @if(count($new_products) > 0)
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">New Items</h2>
                        @foreach($new_products as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset('images/'.$product->product_attachment->file_name)}}" alt="" />
                                            <h2>Rs {{$product->price}}</h2>
                                            <p>{{$product->title}}</p>
                                            <p>@include('/theme/common/rating_display', ['avg_rating' => \App\Models\Rating::avg_rate($product->id), 'product_id' => $product->id])</p>
                                            <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$56</h2>
                                                <p>{{$product->title}}</p>
                                                <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!--features_items-->

                    @endif
                    @if(count($featured_products) > 0)
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @foreach($featured_products as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset('images/'.$product->product_attachment->file_name)}}" alt="" />
                                            <h2>Rs {{$product->price}}</h2>
                                            <p>{{$product->title}}</p>
                                            <p>@include('/theme/common/rating_display', ['avg_rating' => \App\Models\Rating::avg_rate($product->id), 'product_id' => $product->id])</p>
                                            <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$56</h2>
                                                <p>{{$product->title}}</p>
                                                <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    </ul>
                                </div>
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
                                                <p>@include('/theme/common/rating_display', ['avg_rating' => \App\Models\Rating::avg_rate($product->id), 'product_id' => $product->id])</p>
                                                <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            </ul>
                                        </div>
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
                        
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($recomended_products as $k=>$product)
                                <div class="item @if($k==0) active @endif"> 
                                    @foreach($product as $p)  
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{asset('images/'.\App\Models\Product::getAttachmentFromId($p['id']))}}" alt="" />
                                                    <h2>{{$p['price']}}</h2>
                                                    <p>{{$p['title']}}</p>
                                                    <p>@include('/theme/common/rating_display', ['avg_rating' => \App\Models\Rating::avg_rate($p['id']), 'product_id' => $p['id']])</p>
                                                    <a href="{{url('shop/'.$p['slug'])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                            <div class="choose">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                </ul>
                                            </div>

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
    </section>
@endsection