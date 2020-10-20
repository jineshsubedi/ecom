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
                <div class="col-md-3">
                    @include('theme/common/left_sidebar', ['categories' => $categories])
                </div>
                
                <div class="col-md-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Items</h2>
                        @if(count($products) > 0)
                            <div class="col-md-12 row">
                                @foreach($products as $product)
                                <div class="col-md-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{asset('images/'.$product->product_attachment->file_name)}}" alt="" />
                                                <h2>Rs. {{$product->price}}</h2>
                                                <p>{{$product->title}}</p>
                                                <p>@include('/theme/common/rating_display', ['avg_rating' => $product->rate, 'product_id' => $product->id])</p>
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
                            </div>
                        <div class="text-center">
                            <ul class="pagination">
                                @if($products->previousPageUrl())
                                <li><a href="{{$products->previousPageUrl()}}">&laquo;</a></li>
                                @endif

                                <li class="active"><a >{{$products->currentPage()}}</a></li>

                                @if($products->nextPageUrl())
                                <li><a href="{{$products->nextPageUrl()}}">&raquo;</a></li>
                                @endif
                            </ul>
                        </div>
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