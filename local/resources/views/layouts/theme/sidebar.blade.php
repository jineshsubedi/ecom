<!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('images/'.\App\Models\Setting::getLogo())}}" class="logo" width="100px"></a>
                </div>
                <!-- End Header Navigation -->
                <!-- Collect the nav links, forms, and other content for toggling -->

                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/about-us')}}">About Us</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="{{url('/shop')}}">Shop</a></li> -->
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">SHOP</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/shop')}}"><span style='color:#fff;'>Shop</span></a></li>
                                <li><a href="{{url('/cart')}}"><span style='color:#fff;'>Cart</span></a></li>
                                <!-- <li><a href="{{url('/checkout')}}">Checkout</a></li> -->
                            </ul>
                        </li>
                        <!-- <li class="nav-item"><a class="nav-link" href="{{url('/gallery')}}">Gallery</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="{{url('/contact-us')}}">Contact Us</a></li>
                        @guest
                        <li class="nav-item"><a class="nav-link" href="{{url('login')}}"><i class="fa fa-shopping-bag"></i> My Cart</a></li>
                        @endguest
                    </ul>
                </div>

                <!-- /.navbar-collapse -->
                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        <li class="side-menu">
                            @auth
                            <a href="#" id="cartSection">
                                <i class="fa fa-shopping-bag"></i>
                                <span class="badge" id="cartCount"></span>
                                <p>My Cart</p>
                            </a>
                            @endauth
                        </li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                    <ul class="cart-list" id="cart_list">
                       
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation-->
<script src="{{asset('theme/js/jquery-3.2.1.min.js')}}"></script>
<script>
var token = $('input[name=\'_token\']').val();

getMyCart()
// setInterval(function() {
//     // getMyCart()
// }, 10 * 1000);

$('#cartSection').click(function(){
    getMyCart();
})

function getMyCart()
{
    $.ajax({
        url: "{{route('getMyCart')}}",
        type: 'get',
        dataType: 'JSON',
        success:function(data){
            console.log(data)
            $('#cartCount').text(data.count);
            var cartHtml = ''
            $.each(data.cart, function(index, value){
                var image = '{{url("images/")}}'+'/'+value.photo;
                var imageTag = '<img src="'+image+'" class="cart-thumb" alt="" />';
                cartHtml += '<li><a href="#" class="photo">'+imageTag+'</a><h6><a href="#">'+value.item_name+'</a></h6><p>'+value.quantity+'x - <span class="price">Rs. '+value.unit_cost+'</span></p></li>'
            })
            cartHtml += '<li class="total"><a href="{{route("mycart")}}" class="btn btn-default hvr-hover btn-cart">Update Cart</a><span class="float-right"><strong>Total</strong>: Rs. '+data.total+'</span></li>'
            $('#cart_list').html(cartHtml)
        },
        error: function(error){
            // console.log(error)
        }
    });
}
    
</script>