
@auth

@if(\App\Models\Wishlist::checkIsWishlist($product))
<div class="choose product_wish_remove_{{$product}}">
    <ul class="nav nav-pills nav-justified">
        <li onclick="wishlistAction({{$product}})"><a href="javascript:void(0)"><i class="fa fa-check-square"></i>Remove Wishlist</a></li>
    </ul>
</div>
<div class="choose product_wish_add_{{$product}}" style="display:none;">
    <ul class="nav nav-pills nav-justified">
        <li onclick="wishlistAction({{$product}})"><a href="javascript:void(0)"><i class="fa fa-plus-square" ></i>Add to Wishlist</a></li>
    </ul>
</div>
@else
<div class="choose product_wish_remove_{{$product}}" style="display:none;">
    <ul class="nav nav-pills nav-justified">
        <li onclick="wishlistAction({{$product}})"><a href="javascript:void(0)"><i class="fa fa-check-square"></i>Remove Wishlist</a></li>
    </ul>
</div>
<div class="choose product_wish_add_{{$product}}">
    <ul class="nav nav-pills nav-justified">
        <li onclick="wishlistAction({{$product}})"><a href="javascript:void(0)"><i class="fa fa-plus-square" ></i>Add to Wishlist</a></li>
    </ul>
</div>
@endif
@endauth

