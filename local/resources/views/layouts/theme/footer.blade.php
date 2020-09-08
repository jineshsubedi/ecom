<!-- End Instagram Feed  -->
    <!-- Start Footer  -->
    <footer>
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>Business Time</h3>
                            <!-- <ul class="list-time">
                                <li>Sunday - Friday: 08.00am to 07.00pm</li>
                                <li>Saturday: 10.00am to 05.00pm</li>
                            </ul> -->
                            <p class="text-white">{!! \App\Models\Setting::getBusinessTime() !!}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>Social Media</h3>
                            <p>Follow Us On Social Media's</p>
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i> {{\App\Models\Setting::getAddress()}}</p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:{{\App\Models\Setting::getMainPhone()}}"> {{\App\Models\Setting::getPhone()}}</a></p>
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: <a href="mailto:{{\App\Models\Setting::getEmail()}}">{{\App\Models\Setting::getEmail()}}</a></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->
    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; {{Date('Y')}}</p>
    </div>
    <!-- End copyright  -->
    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>
    <!-- ALL JS FILES -->
    <script src="{{asset('theme/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('theme/js/popper.min.js')}}"></script>
    <script src="{{asset('theme/js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('theme/js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('theme/js/jquery.superslides.min.js')}}"></script>
    <script src="{{asset('theme/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('theme/js/inewsticker.js')}}"></script>
    <script src="{{asset('theme/js/bootsnav.js')}}"></script>
    <script src="{{asset('theme/js/images-loded.min.js')}}"></script>
    <script src="{{asset('theme/js/isotope.min.js')}}"></script>
    <script src="{{asset('theme/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('theme/js/baguetteBox.min.js')}}"></script>
    <script src="{{asset('theme/js/form-validator.min.js')}}"></script>
    <script src="{{asset('theme/js/contact-form-script.js')}}"></script>
    <script src="{{asset('theme/js/custom.js')}}"></script>
</body>

</html>
