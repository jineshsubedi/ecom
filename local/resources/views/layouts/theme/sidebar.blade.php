<div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 clearfix">
                        <div class="logo pull-left">
                            <a href="{{url('/')}}"><img src="{{asset('images/'.\App\Models\Setting::getLogo())}}" width="80px"/></a>
                        </div>
                    </div>
                    <div class="col-md-8 clearfix">
                        <div class="shop-menu clearfix pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="{{url('/')}}"><i class="fa fa-home"></i> Home</a></li>
                                <li><a href="{{url('/shop')}}"><i class="fa fa-shopping-bag"></i> Shop</a></li>
                                @auth
                                @if(auth()->user()->role=='customer')
                                <li><a href="{{route('mycustomer.index')}}"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="{{route('wishlist')}}"><i class="fa fa-star"></i> Wishlist</a></li>
                                <li><a href="{{route('mycheckout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li><a href="{{route('mycart')}}"><i class="fa fa-shopping-cart"></i>Cart <sup id="updateCartCount">
                                    {{\App\Models\Cart::countMyCartItem()}}
                                </sup></a></li>
                                @else 
                                <li><a href="{{route('home')}}"><i class="fa fa-user"></i> Account</a></li>
                                @endif
                                @endauth
                                @guest
                                <li><a href="{{route('login')}}"><i class="fa fa-lock"></i> Login</a></li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->
        <!-- group accessible -->
        @php($groups = \App\Models\Group::getGroup())
        @if(count($groups) > 0)
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                @foreach($groups as $group)
                                <li><a href="{{url('group/'.$group->slug)}}" class="">{{ucwords($group->title)}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        @endif