<style type="text/css">
    .rating {
      display: inline-block;
      unicode-bidi: bidi-override;
      color: #888888;
      font-size: 25px;
      height: 25px;
      width: auto;
      margin: 0;
      position: relative;
      padding: 0;
    }

    .rating-upper {
      color: #ffd920;
      padding: 0;
      position: absolute;
      z-index: 0;
      display: flex;
      top: 0;
      left: 0;
      overflow: hidden;
    }

    .rating-lower {
      padding: 0;
      display: flex;
      z-index: 0;
    }
</style>
<div class="rating">
    <div class="rating-upper" style="width: 0%" >
        <span>★</span>
        <span>★</span>
        <span>★</span>
        <span>★</span>
        <span>★</span>
    </div>
    <div class="rating-lower">
        <span>★</span>
        <span>★</span>
        <span>★</span>
        <span>★</span>
        <span>★</span>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
<script src="{{asset('theme/js/rating.js')}}"></script>
<script>
    var avg_rating = '{{$avg_rating}}';
    var percentage = (avg_rating/5)*100;
    percentage.toFixed(2);
    $(".rating-upper").css({
        width: percentage+"%"
    });
</script>