	<link rel="stylesheet" href="{{asset('theme/imageViewer/css/smoothproducts.css')}}">
	<style type="text/css">
	ul {
		overflow: hidden;
	}
	pre {
		background: #333;
		padding: 10px;
		overflow: auto;
		color: #BBB7A9;
	}
	.button {
		text-decoration: none;
		color: #F0353A;
		border: 2px solid #F0353A;
		padding: 6px 10px;
		display: inline-block;
		font-size: 18px;
	}
	.button:hover {
		background: #F0353A;
		color: #fff;
	}
	.clear {
		clear: both;
	}
	</style>

</head>

<body>
	<br>
		<div class="sp-wrap">
			@foreach($product->product_attachments as $attachment)
			<a href="{{asset('images/'.$attachment->file_name)}}"><img src="{{asset('images/'.$attachment->file_name)}}" alt=""></a>
			@endforeach
		</div>
	<br>
	<!-- JS ======================================================= -->
	<script type="text/javascript" src="{{asset('/theme/imageViewer/js/jquery-2.1.3.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('/theme/imageViewer/js/smoothproducts.min.js')}}"></script>
	<script type="text/javascript">
	/* wait for images to load */
	$('.sp-wrap').smoothproducts();
	</script>

</body>

</html>
