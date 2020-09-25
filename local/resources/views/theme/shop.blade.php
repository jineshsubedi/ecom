@extends('layouts.theme.app')
@section('content')

<section id="advertisement">
    <div class="container">
        <img src="{{asset('theme/images/shop/advertisement.jpg')}}" alt="bjhghf" />
    </div>
</section>

<!-- Start Shop Page  -->
<section>
        <div class="container">
        <img src="{{asset('theme/images/shop/advertisement.jpg')}}" alt="bjhghf" />
    </div>
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
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Items</h2>
                        @if(count($products) > 0)
                        @foreach($products as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('images/'.$product->product_attachment->file_name)}}" alt="" />
                                        <h2>Rs. {{$product->price}}</h2>
                                        <p>{{$product->title}}</p>
                                        <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>Rs. {{$product->price}}</h2>
                                            <p>{{$product->title}}</p>
                                            <a href="{{url('shop/'.$product->slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        <ul class="pagination">
                            @if($products->previousPageUrl())
                            <li><a href="{{$products->previousPageUrl()}}">&laquo;</a></li>
                            @endif

                            <li class="active"><a >{{$products->currentPage()}}</a></li>

                            @if($products->nextPageUrl())
                            <li><a href="{{$products->nextPageUrl()}}">&raquo;</a></li>
                            @endif
                        </ul>

                        @else
                        <div class="col-sm-12">
                            <div class="alert alert-info">
                                No Item Found!
                            </div>
                        </div>
                        @endif
                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>
<!-- End Shop Page -->

@endsection