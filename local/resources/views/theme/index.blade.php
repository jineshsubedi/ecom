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
    <section id="featured_section">
        <div class="container">
            <div class="row">
            <div class="col-md-3">
                <a href="">
                    <img src="https://www.webstaurantstore.com/images/home-page-ads/2/244715FC-C56E-7A0D-371E4B425F0D7CEE.jpg" width="100%">
                </a>
            </div>
            <div class="col-md-3">
                <a href="">
                    <img src="https://www.webstaurantstore.com/images/home-page-ads/2/24519A14-E63B-DC83-AEED27193645CEF6.jpg" width="100%">
                </a>
            </div>
            <div class="col-md-3">
                <a href="">
                    <img src="https://www.webstaurantstore.com/images/home-page-ads/2/245B3A47-F2E4-559E-25F5662B5F487694.jpg" width="100%">
                </a>
            </div>
            <div class="col-md-3">
                <a href="">
                    <img src="https://www.webstaurantstore.com/images/home-page-ads/2/2461F680-C9BA-70AC-E442162ACD5407C2.jpg" width="100%">
                </a>
            </div>
            </div>
        </div>
    </section>
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
                                                    <a href="{{url('shop/'.$p['slug'])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
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
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach($categories as $category)
                            @if(count($category->sub_category) > 0)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="{{url('/shop?filter_category='.$category->slug)}}">
                                            <span class="badge pull-right" data-toggle="collapse" data-parent="#accordian" href="#{{$category->slug}}"><i class="fa fa-plus"></i></span>
                                            {{$category->title}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="{{$category->slug}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            @foreach($category->sub_category as $subcategory)
                                            <li><a href="{{url('/shop?filter_sub_category='.$subcategory->slug)}}">{{$subcategory->title}} </a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{url('/shop?filter_category='.$category->slug)}}">{{$category->title}}</a></h4>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Brands</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                                    <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                                    <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                                    <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                                    <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                                    <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                                    <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">Rs {{\App\Models\Product::getMinimumPrice()}}</b> <b class="pull-right">Rs {{\App\Models\Product::getMaximumPrice()}}</b>
                            </div>
                        </div><!--/price-range-->
                        
                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{asset('theme/images/home/shipping.jpg')}}" alt="" />
                        </div><!--/shipping-->
                    
                    </div>
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
                                                <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
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
                                                    <a href="{{url('shop/'.$p['slug'])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
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