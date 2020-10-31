<!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    @php($logo = \App\Models\Setting::getLogo())
                    @if($logo)
                    <a href="{{url('/')}}"><img src="{{asset('images/'.$logo)}}" alt="logo"></a>
                    @else
                    <a href="{{url('/')}}"><img src="assets/images/icon/logo.png" alt="logo"></a>
                    @endif
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                        @if(Auth::user()->role != 'customer')
                            <li @if(Request::segment(1)=='dashboard' ) class="active" @endif>
                                <a href="{{route('home')}}" aria-expanded="false"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li @if(Request::segment(2)=='profile' ) class="active" @endif>
                                <a href="{{route('profile', Auth::user()->id)}}" aria-expanded="false"><i class="ti-layout-tab"></i><span>Profile</span></a>
                            </li>
                            @if(Auth::user()->role == 'super admin')
                            <li @if(Request::segment(2)=='setting' ) class="active" @endif>
                                <a href="{{route('setting')}}" aria-expanded="false"><i class="ti-settings"></i><span>Setting</span></a>
                            </li>
                            <li @if(Request::segment(2)=='user' ) class="active" @endif>
                                <a href="{{route('user.index')}}" aria-expanded="false"><i class="ti-user"></i><span>User</span></a>
                            </li>
                            @endif
                            <li @if(Request::segment(2)=='slider' ) class="active" @endif>
                                <a href="{{route('slider.index')}}" aria-expanded="false"><i class="fa fa-image"></i><span>Slider</span></a>
                            </li>
                            <li @if(Request::segment(2)=='customer' ) class="active" @endif>
                                <a href="{{route('customer.index')}}" aria-expanded="false"><i class="fa fa-users"></i><span>Customer</span></a>
                            </li>
                            <li @if(Request::segment(2)=='category' ) class="active" @endif>
                                <a href="{{route('category.index')}}" aria-expanded="false"><i class="ti-bag"></i><span>Category</span></a>
                            </li>
                            <li @if(Request::segment(2)=='sub_category' ) class="active" @endif>
                                <a href="{{route('sub_category.index')}}" aria-expanded="false"><i class="ti-bag"></i><span>Sub Category</span></a>
                            </li>
                            <li @if(Request::segment(2)=='product' ) class="active" @endif>
                                <a href="{{route('product.index')}}" aria-expanded="false"><i class="ti-bag"></i><span>Product</span></a>
                            </li>
                            <li @if(Request::segment(2)=='order' ) class="active" @endif>
                                <a href="{{route('order.index')}}" aria-expanded="false"><i class="ti-shopping-cart"></i><span>Order</span></a>
                            </li>
                            <li @if(Request::segment(2)=='blog' ) class="active" @endif>
                                <a href="{{route('blog.index')}}" aria-expanded="false"><i class="ti-rss"></i><span>Blog</span></a>
                            </li>
                            <li @if(Request::segment(2)=='message' ) class="active" @endif>
                                <a href="{{route('message.index')}}" aria-expanded="false"><i class="ti-comment-alt"></i><span>Messages</span></a>
                            </li>
                            <li @if(Request::segment(2)=='page' ) class="active" @endif>
                                <a href="{{route('page.index')}}" aria-expanded="false"><i class="fa fa-image"></i><span>Page</span></a>
                            </li>
                        @else
                            <li @if(Request::segment(1)=='home' ) class="active" @endif>
                                <a href="{{route('mycustomer.index')}}" aria-expanded="false"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li @if(Request::segment(1)=='profile' ) class="active" @endif>
                                <a href="{{route('profile', Auth::user()->id)}}" aria-expanded="false"><i class="ti-layout-tab"></i><span>Profile</span></a>
                            </li>
                            <li @if(Request::segment(1)=='myorder' ) class="active" @endif>
                                <a href="{{route('myorder')}}" aria-expanded="false"><i class="ti-shopping-cart"></i><span>My Order</span></a>
                            </li>
                        @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->