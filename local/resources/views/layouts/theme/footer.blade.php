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
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privecy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                            <li><a href="#">Billing System</a></li>
                            <li><a href="#">Ticket System</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Company Information</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Store Location</a></li>
                            <li><a href="#">Affillate Program</a></li>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>{{\App\Models\Setting::getName()}}</h2>
                        <p>{{\App\Models\Setting::getSubName()}}</p>
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
  
<script src="{{asset('theme/js/jquery.js')}}"></script>
<script src="{{asset('theme/js/bootstrap.min.js')}}"></script>
<script src="{{asset('theme/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('theme/js/price-range.js')}}"></script>
<script src="{{asset('theme/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('theme/js/main.js')}}"></script>
</body>
</html>