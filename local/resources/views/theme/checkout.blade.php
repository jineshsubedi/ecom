@extends('layouts.theme.app')
@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="#">Home</a></li>
                  <li class="active">Check out</li>
                </ol>
            </div><!--/breadcrums-->
    </section>
    <!-- Start Cart  -->
    <div class="cart-box-main mb-3">
        <div class="container" style="border: 1px solid #2b2b63; border-radius: 5px;">
            <div class="row">
                <div class="col-sm-8 col-lg-8 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h2>Billing address</h2>
                        </div>
                        <form action="{{route('place_order')}}" method="post">
                            @csrf
                            @php($address = \App\Models\CustomerAddress::getMyAddress())
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name *</label>
                                    <input type="text" class="form-control" name="first_name" id="firstName" placeholder="" value="{{isset($address->first_name) ? $address->first_name : ''}}" required>
                                    <!-- <div class="invalid-feedback"> Valid first name is required. </div> -->
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name *</label>
                                    <input type="text" class="form-control" name="last_name" id="lastName" placeholder="" value="{{isset($address->last_name) ? $address->last_name : ''}}" required>
                                    <!-- <div class="invalid-feedback"> Valid last name is required. </div> -->
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address *</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="" value="{{isset($address->email) ? $address->email : ''}}" required>
                                <!-- <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div> -->
                            </div>
                            <div class="mb-3">
                                <label for="phone_number">Phone Number *</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="" value="{{isset($address->phone_number) ? $address->phone_number : ''}}" required>
                                <!-- <div class="invalid-feedback"> Please enter a valid phone_number address for shipping updates. </div> -->
                            </div>
                            <div class="mb-3">
                                <label for="address">Street *</label>
                                <input type="text" class="form-control" name="street" id="address" placeholder="" value="{{isset($address->street) ? $address->street : ''}}" required>
                                <!-- <div class="invalid-feedback"> Please enter your shipping address. </div> -->
                            </div>
                            <div class="mb-3">
                                <label for="address2">City *</label>
                                <input type="text" class="form-control" name="city" id="address2" placeholder="" value="{{isset($address->city ) ? $address->city  : ''}}" required> </div>
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Country *</label>
                                    <select class="wide w-100" id="country" name="country">
									<option value="nepal" data-display="Select">Nepal</option>
								</select>
                                    <!-- <div class="invalid-feedback"> Please select a valid country. </div> -->
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">State *</label>
                                    <input type="text" name="state" name="state" class="form-control" id="state" value="{{isset($address->state) ? $address->state : ''}}" required>
                                    <!-- <div class="invalid-feedback"> Please provide a valid state. </div> -->
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip *</label>
                                    <input type="text" class="form-control" name="zip" id="zip" placeholder="" value="{{isset($address->zip) ? $address->zip : ''}}" required>
                                    <!-- <div class="invalid-feedback"> Zip code required. </div> -->
                                </div>
                            </div>
                            <hr class="mb-4">
                            
                            <div class="title"> <span>Payment</span> </div>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required value="1">
                                    <label class="custom-control-label" for="credit">Cash On Delivery</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required disabled value="2">
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <hr class="mb-1"> 
                    </div>
                </div>
                <div class="col-sm-4 col-lg-4 mb-3">
                    <div class="row">
                        <!-- <div class="col-md-12 col-lg-12">
                            <div class="shipping-method-box">
                                <div class="title-left">
                                    <h3>Shipping Method</h3>
                                </div>
                                <div class="mb-4">
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption1" name="shipping-option" class="custom-control-input" checked="checked" type="radio">
                                        <label class="custom-control-label" for="shippingOption1">Standard Delivery</label> <span class="float-right font-weight-bold">FREE</span> </div>
                                    <div class="ml-4 mb-2 small">(3-7 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption2" name="shipping-option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption2">Express Delivery</label> <span class="float-right font-weight-bold">$10.00</span> </div>
                                    <div class="ml-4 mb-2 small">(2-4 business days)</div>
                                    <div class="custom-control custom-radio">
                                        <input id="shippingOption3" name="shipping-option" class="custom-control-input" type="radio">
                                        <label class="custom-control-label" for="shippingOption3">Next Business day</label> <span class="float-right font-weight-bold">$20.00</span> </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold"> RS. {{$datas['total']}} </div>
                                </div>
                                <!-- <div class="d-flex">
                                    <h4>Discount</h4>
                                    <div class="ml-auto font-weight-bold"> - </div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Coupon Discount</h4>
                                    <div class="ml-auto font-weight-bold"> - </div>
                                </div>
                                <div class="d-flex">
                                    <h4>Tax</h4>
                                    <div class="ml-auto font-weight-bold"> {{$datas['tax']}} </div>
                                </div> -->
                                <div class="d-flex">
                                    <h4>Shipping Cost</h4>
                                    <div class="ml-auto font-weight-bold"> {{$datas['shipping_type']}} </div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5"> Rs. {{$datas['net_total']}} </div>
                                    <input type="hidden" name="net_total" value="{{$datas['net_total']}}">
                                    <input type="hidden" name="shipping_amount" value="0.0">
                                    <input type="hidden" name="tax_amount" value="0.0">
                                </div>
                                <hr> </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"> 
                            <button type="submit" class="ml-auto btn hvr-hover btn btn-info">Place Order</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>
    <!-- End Cart -->
    <div class="mb-3"></div>
@endsection