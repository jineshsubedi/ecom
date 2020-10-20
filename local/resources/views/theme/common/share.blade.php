<script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
<script src="{{asset('theme/sharebox/jquery.sharebox.js')}}"></script>
<link href="{{asset('theme/sharebox/jquery.sharebox.css')}}" rel="stylesheet">
<style>
	.sharebox {
        margin:1em 0;
    }
</style>
<hr>
<div class="sharebox" data-services="digg facebook google+ instagram linkedin pinterest pocket reddit stumbleupon tumblr twitter print" data-title="{{\App\Models\Setting::getName()}}" data-url="{{$url}}"></div>