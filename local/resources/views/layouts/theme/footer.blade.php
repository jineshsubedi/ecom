<footer id="footer"><!--Footer-->
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Business Time:</h2>
                        {!! \App\Models\Setting::getBusinessTime() !!}
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Quock Shop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">T-Shirt</a></li>
                            <li><a href="#">Mens</a></li>
                            <li><a href="#">Womens</a></li>
                            <li><a href="#">Gift Cards</a></li>
                            <li><a href="#">Shoes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Policies</h2>
                        @php($pages = \App\Models\Page::getFooterPages())
                        <ul class="nav nav-pills nav-stacked">
                            @foreach($pages as $page)
                            <li><a href="{{url('page/'.$page->slug)}}">{{$page->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Follow us</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Facebook </a></li>
                            <li><a href="#">Instagram</a></li>
                            <li><a href="#">Twitter</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>{{\App\Models\Setting::getName()}}</h2>
                        <div class="fb-page" data-href="https://www.facebook.com/jineshcast" data-tabs="" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/jineshcast" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/jineshcast">Jineshsubedi.com.np</a></blockquote></div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © {{Date('Y')}} {{\App\Models\Setting::getName()}}. All rights reserved.</p>
                <!-- <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p> -->
            </div>
        </div>
    </div>
</footer><!--/Footer-->
 <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v8.0&appId=1868322490092491&autoLogAppEvents=1" nonce="OhfUoG89"></script> 
<script src="{{asset('theme/js/jquery.js')}}"></script>
<script src="{{asset('theme/js/bootstrap.min.js')}}"></script>
<script src="{{asset('theme/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('theme/js/price-range.js')}}"></script>
<script src="{{asset('theme/js/jquery.prettyPhoto.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('theme/js/main.js')}}"></script>
<script type="text/javascript">
    var token = $('input[name=\'_token\']').val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    function wishlistAction(product)
    {
        $.ajax({
            url: "{{route('wishlist_action')}}",
            type: 'post',
            data:{
                _token : token,
                product_id : product
            },
            dataType: 'JSON',
            success:function(data){
                console.log(data)
                if(data.action == 'add')
                {
                    $('.product_wish_add_'+product).hide();
                    $('.product_wish_remove_'+product).show();
                }
                if(data.action == 'remove')
                {
                    $('.product_wish_add_'+product).show();
                    $('.product_wish_remove_'+product).hide();
                }
                swal({
                  title: "Success!",
                  text: data.message,
                  icon: "success",
                  button: "OK",
                });
            },
            error:function(error)
            {
                console.log(error)
            }
        });
    }
</script>
</body>
</html>