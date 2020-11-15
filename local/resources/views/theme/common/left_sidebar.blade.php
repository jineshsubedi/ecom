<div class="left-sidebar">
    <h2>Search</h2>
    <div class="well form-group">
            <div class="input-group">
              <input type="text" class="form-control" id="search" value="{{$data['filter_search']}}" placeholder="search product by title">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" onclick="searchBtn()"><i class="fa fa-search"></i></button>
              </span>
            </div><!-- /input-group -->
    </div>
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        @foreach($categories as $category)
        @if(count($category->sub_category) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href="{{url('/shop?filter_category='.$category->slug)}}">
                        <span class="badge pull-right" data-toggle="collapse" data-parent="#accordian" href="#{{$category->slug}}"><i class="fa fa-plus"></i></span>
                        {{$category->title}}
                    </a>
                </h4>
            </div>
            <div id="{{$category->slug}}" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        @foreach($category->sub_category as $subcategory)
                        <li><a href="{{url('/shop?filter_sub_category='.$subcategory->slug)}}">{{$subcategory->title}} </a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @else
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a href="{{url('/shop?filter_category='.$category->slug)}}">{{$category->title}}</a></h4>
            </div>
        </div>
        @endif
        @endforeach
    </div><!--/category-products-->
    @php($brands = \App\Models\Product::getProductTopBrand())
    @if(count($brands) > 0)
    <div class="brands_products"><!--brands_products-->
        <h2>Brands</h2>
        <div class="brands-name">
            <ul class="nav nav-pills">
                @foreach($brands as $b)
                    @if($data['filter_brand'] == $b)
                    <li class="active"><a href="{{url('shop?filter_brand='.$b)}}"> <span class="pull-right">({{\App\Models\Product::countProductByBrand($b)}})</span>{{ucwords($b)}}</a></li>
                    @else
                    <li><a href="{{url('shop?filter_brand='.$b)}}"> <span class="pull-right">({{\App\Models\Product::countProductByBrand($b)}})</span>{{ucwords($b)}}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div><!--/brands_products-->
    @endif
    <div class="shipping text-center"><!--shipping-->
        <!-- <img src="{{asset('theme/images/home/shipping.jpg')}}" alt="" /> -->
    </div>
</div> 
<script src="{{asset('theme/js/jquery.js')}}"></script>
<script type="text/javascript">
    function searchBtn()
    {
        var search = $('#search').val();
        var brand = '{{$data["filter_brand"]}}';
        var category = '{{$data["filter_category"]}}';
        var sub_category = '{{$data["filter_sub_category"]}}';
        var url = '{{url("/shop?")}}';

        if(search != null){
            url += '&filter_search='+search;
        }
        if(brand != null){
            url += '&filter_brand='+brand;
        }
        if(category != null){
            url += '&filter_category='+category;
        }
        if(sub_category != null){
            url += '&filter_sub_category='+sub_category;
        }

        location = url;
    }
</script>
