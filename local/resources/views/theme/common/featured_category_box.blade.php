@php($featured_cats = \App\Models\Category::getFeaturedCats())
@php($count = count($featured_cats))
@if($count > 0)
    <section id="featured_section">
        <div class="container">
            <h2 class="title text-center">Featured Category</h2>
            <div class="row">
                @foreach($featured_cats as $category)
                <div class="col-md-3">
                <div  style="box-shadow: 0px 3px 14px #2b2b63; padding: 10px;">
                    <a href="{{url('/shop?filter_category='.$category->slug)}}">
                        <img src="{{asset('/images/'.$category->image)}}" style="object-fit: contain; width:240px; height: 175px">
                    </a>
                </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endif