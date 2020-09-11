<div class="shop-menu clearfix pull-right">
    <ul class="nav navbar-nav">
        <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
        <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
        <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
        @guest
        <li><a href="{{route('login')}}"><i class="fa fa-lock"></i> Login</a></li>
        @endguest
        @auth
        <li><a href="{{route('mycustomer.index')}}"><i class="fa fa-user"></i> Account</a></li>
        @endauth
    </ul>
</div>