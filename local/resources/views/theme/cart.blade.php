@extends('layouts.theme.app')
@section('content')

<!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <form method="post" action="{{route('updateCart')}}">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 20$">Images</th>
                                    <th style="width: 20$">Product Name</th>
                                    <th style="width: 20$">Price</th>
                                    <th style="width: 20$">Quantity</th>
                                    <th style="width: 20$">Total</th>
                                    <th style="width: 20$">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mycart['cart'] as $cart)
                                <input type="hidden" name="cart[]" value={{$cart->id}}>
                                <tr id="cartTable{{$cart->id}}">
                                    <td class="thumbnail-img">
                                        <a href="#">
									       <img class="img-fluid" src="{{asset('images/'.$cart->photo)}}" alt="" />
								        </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									       {{$cart->item_name}}
								        </a>
                                    </td>
                                    <td class="price-pr">
                                        <p>Rs. {{$cart->unit_cost}}</p>
                                        <input type="hidden" id="unitCost{{$cart->id}}" value="{{$cart->unit_cost}}">
                                    </td>
                                    <td class="quantity-box">
                                        <input type="number" size="4" value="{{$cart->quantity}}" min="1" step="1" class="c-input-text qty text" id="quantityControl{{$cart->id}}" name="quantity[]" onchange="updateTotalAmount({{$cart->id}})">
                                    </td>
                                    <td class="total-pr">
                                        <p id="total_cost{{$cart->id}}">Rs. {{$cart->total_cost}}</p>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="javascript:void(0)">
									       <i class="fas fa-times" onclick="removeCart({{$cart->id}})"></i>
								        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-12 col-sm-12">
                    <div class="update-box">
                        <input value="Update Cart / Checkout" type="submit">
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- End Cart -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    var token = $('input[name=\'_token\']').val();
    function removeCart(id)
    {
        
        $.ajax({
            url: "{{route('cartRemoveItem')}}",
            type: 'POST',
            data: {
                _token : token,
                id : id
            },
            dataType: 'JSON',
            success:function(data){
                $('#cartTable'+id).remove();
                getMyCart();
                swal({
                  title: "Success!",
                  text: "Cart Item Removed Successfully",
                  icon: "success",
                  button: "OK",
                });
            },
            error: function(error){
                console.log(error)
                swal({
                  title: "Failer!",
                  text: "Cart Item Removed UnSuccessfully",
                  icon: "error",
                  button: "OK",
                });
            }
        });
    }
    function updateTotalAmount(id)
    {
        var quantity = parseInt($('#quantityControl'+id).val());
        var unit_cost = parseFloat($('#unitCost'+id).val());
        var total = quantity * unit_cost;
        total = Math.round(total * 100) / 100
        $('#total_cost'+id).html('Rs. '+total)
    }
</script>
@endsection