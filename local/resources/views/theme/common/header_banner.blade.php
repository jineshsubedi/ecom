<style>
	.bg-image {
	  height: auto; 
	  background-position: center;
	  background-repeat: no-repeat;
	  background-size: cover;
	  padding: 10px;
	}
	.img1 { background-image: url("{{asset('images/'.$image)}}"); }
</style>
<div class="container" style="height: 400px">
	<div class="bg-image img1">
	    <div class="breadcrumbs">
	        <ol class="breadcrumb">
	          <li><a href="{{url('/')}}">Home</a></li>
	          <li class="active">{{$data['group']->title}}</li>
	        </ol>
	    </div>
		<div style="background-color: #00000069;padding: 10px;color: #fff;">
			<h2>{{$title}}</h2>
			<p>{!! $description !!}</p>
		</div>
	</div>
</div>
