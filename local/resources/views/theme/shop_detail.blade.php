@extends('layouts.theme.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<section>
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{url('/shop')}}">Shop</a></li>
              <li class="active">{{$product->title}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-3">
                @include('theme/common/left_sidebar', ['categories' => $categories])
            </div>
            
            <div class="col-sm-9 padding-right">
                    <div class="product-details">
                        <!--product-details-->
                        <div class="col-sm-5">
                            @include('/theme/common/product_maginifier', ['product' => $product])
                            @include('theme/common/wishlist_action', ['product' => $product->id])
                        </div>

                        <div class="col-sm-7">
                            <div class="product-information">
                                <!--/product-information-->
                                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                <h2>{{$product->title}}</h2>
                                
                                @include('/theme/common/rating_display', ['avg_rating' => $avg_rating, 'product_id'=> $product->id, 'type' => 'products'])

                                <form action="{{route('add_to_cart')}}" method="post">
                                @csrf
                                <span>
                                    <span>NPR {{$product->price}}</span>
                                    <label>Quantity:</label>
                                    <input type="number" name="quantity" value="{{$product->inventory > 0 ? 1 : 0}}" min="1" max="{{$product->inventory}}"/>
                                    <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                    <input type="hidden" name="unit_cost" value="{{$product->price}}"/>
                                    <button type="submit" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                </span>

                                </form>
                                <p><b>Availability:</b> @if($product->inventory > 0) In Stock ({{$product->inventory}}) @else <span class="text-danger">Out of stock!</span> @endif</p>
                                @if($product->new == 1)
                                <p><b>Condition:</b> New</p>
                                @endif
                                <p><b>Brand:</b> {{$product->brand}}</p>
                                <p><b>Views:</b> {{$product->visits}}</p>
                                @php($url = url('/shop/'.$product->slug))
                                @include('/theme/common/share', ['url'=> $url])

                            </div>
                            <!--/product-information-->
                        </div>
                    </div>
                    <!--/product-details-->
                    <div class="category-tab shop-details-tab">
                        <!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
                                <!-- <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
                                <li><a href="#tag" data-toggle="tab">Tag</a></li> -->
                                <li><a href="#reviews" data-toggle="tab">Reviews ({{count($ratings)}})</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="details">
                                {!! $product->description !!}
                            </div>
                            <div class="tab-pane fade" id="reviews">
                                <div class="col-sm-12">
                                    @if(auth()->check())
                                    <p><b>Write Your Review</b></p>
                                    <form action="{{route('rating')}}" method="post">
                                        @csrf
                                        <span>
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="text" name="name" placeholder="Your Name" value="{{old('name')}}" />
                                            @if ($errors->has('name'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                            <input type="email" name="email" placeholder="Email Address" value="{{old('email')}}" />
                                            @if ($errors->has('email'))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </span>
                                        <textarea name="description">{{old('description')}}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                        <b>Rating: </b> 
                                        <span id="halfstarsReview"></span>
                                        @if ($errors->has('rate'))
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $errors->first('rate') }}</strong>
                                            </span>
                                        @endif
                                        <input type="hidden" name="rate" id="half_rate_star">
                                        <button type="submit" class="btn btn-default pull-right">
                                            Submit
                                        </button>
                                    </form>
                                    @else
                                    <p><b>Login to Write a Review.</b></p>
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                                @if(count($ratings) > 0)
                                <div class="col-sm-12" style="margin-top: 20px;  border:1px solid grey; padding: 20px; max-height: 400px; overflow-y: scroll">
                                    <div>
                                        @foreach($ratings as $rating)
                                        <ul>
                                            <li><a href=""><i class="fa fa-user"></i>{{$rating->name}}</a></li>
                                            <li><a href=""><i class="fa fa-clock-o"></i>{{\Carbon\Carbon::parse($rating->created_at)->format('H:i a')}}</a></li>
                                            <li><a href=""><i class="fa fa-calendar-o"></i>{{\Carbon\Carbon::parse($rating->created_at)->format('d M, Y')}}</a></li>
                                            @if(auth()->check())
                                            @if($rating->user_id == auth()->user()->id)
                                            <li><a href="{{route('deleteRating', $rating->id)}}" class="text-danger" onclick="return confirm('are you sure?')"><i class="fa fa-trash"></i>Remove</a></li>
                                            @endif
                                            @endif
                                        </ul>
                                        <p>{!! $rating->description !!}</p>
                                        <hr>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!--/category-tab-->
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
                                                    <p>@include('/theme/common/rating_display', ['avg_rating' => \App\Models\Rating::avg_rate($p['id']), 'product_id' => $p['id'], 'type' => 'recomended_product'])</p>
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
                    <!--/recommended_items-->
            </div>
        </div>
    </div>
</section>
<script src="{{asset('theme/js/rating.js')}}"></script>
<script type="text/javascript">
    $("#halfstarsReview").rating({
        "half": true,
        "click": function (e) {
            $("#half_rate_star").val(e.stars);
        }
    });
</script>
@endsection