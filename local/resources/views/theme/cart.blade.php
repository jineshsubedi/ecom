@extends('layouts.theme.app')
@section('content')

    <!-- Start Cart  -->
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="#">Home</a></li>
                  <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <form method="post" action="{{route('updateCart')}}">
            @csrf
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mycart['cart'] as $cart)
                        <input type="hidden" name="cart[]" value={{$cart->id}}>
                        <tr>
                            <td class="cart_product">
                                <a href="{{url('cart/'.$cart->product_slug)}}" target="_blank"><img src="{{asset('images/'.$cart->product_image)}}" width="100px"></a>
                            </td>
                            <td class="cart_description">
                                <a href="{{url('cart/'.$cart->product_slug)}}">{{$cart->product_name}}</a>
                            </td>
                            <td class="cart_price">
                                <p>Rs. {{$cart->unit_cost}}</p>
                                <input type="hidden" id="unitCost{{$cart->id}}" value="{{$cart->unit_cost}}">
                            </td>
                            <td class="cart_quantity quantity-box">
                                <div class="cart_quantity_button">
                                    <input type="number" size="4" value="{{$cart->quantity}}" min="1" step="1" class="c-input-text qty text" id="quantityControl{{$cart->id}}" name="quantity[]" onchange="updateTotalAmount({{$cart->id}})">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price" id="total_cost{{$cart->id}}">Rs. {{$cart->total_cost}}</p>
                            </td>
                            <td class="cart_delete">
                                <a href="javascript:void(0)">
                                   <i class="fa fa-times" onclick="removeCart({{$cart->id}})"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="2">
                                <table class="table table-condensed total-result">
                                    <tbody><tr>
                                        <td>Cart Sub Total</td>
                                        <td>Rs. {{$mycart['total']}}</td>
                                    </tr>
                                    <tr>
                                        <td>Exo Tax</td>
                                        <td>{{$mycart['tax']}}</td>
                                    </tr>
                                    <tr class="shipping-cost">
                                        <td>Shipping Cost</td>
                                        <td>{{$mycart['shipping_type']}}</td>                                       
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><span>Rs. {{$mycart['net_total']}}</span></td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="update-box text-right">
                            <input value="Update Cart" type="submit" class="check_out">
                            <a href="{{route('mycheckout')}}" class="check_out">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section> <!--/#cart_items-->
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
