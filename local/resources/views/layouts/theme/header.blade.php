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
								<li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
								<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fas fa-basketball-ball"></i></a></li>
								<li><a href="#"><i class="fab fa-google-plus-square"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		@include('layouts.theme.sidebar')
		
	</header><!--/header-->