<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="tel:{{\App\Models\Setting::getMainPhone()}}"><i class="fa fa-phone"></i> {{\App\Models\Setting::getMainPhone()}}</a></li>
								<li><a href="mailto:{{\App\Models\Setting::getEmail()}}"><i class="fa fa-envelope"></i> {{\App\Models\Setting::getEmail()}}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="{{url('/')}}"><img src="{{asset('images/'.\App\Models\Setting::getLogo())}}" alt="" /></a>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						@include('layouts.theme.sidebar')
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	</header><!--/header-->