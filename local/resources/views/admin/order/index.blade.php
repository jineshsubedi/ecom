@extends('layouts.backend.app')
@section('breadcrums')
<div class="breadcrumbs-area clearfix">
    <ul class="breadcrumbs pull-left">
        <li><a href="{{route('order.index')}}">Order</a></li>
        <li><span>Index</span></li>
    </ul>
</div>
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection
@section('content')
<div class="main-content-inner">
    <!-- sales report area start -->
    <div class="sales-report-area mb-5">
        <div class="row">
        	<div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('order.create')}}" class="btn btn-xs btn-primary pull-right"><i class="ti-plus"></i> Add New</a>
                        <h4 class="header-title">Order's List</h4>
                        <div class="row">
                            <div class="col-md-2">
                                <input type="text" name="filter_customer" id="filter_customer" class="form-control" placeholder="search customer">
                            </div>
                            <div class="col-md-2">
                                <select name="filter_product" id="filter_product" class="form-control">
                                    <option value="">Select Product</option>
                                    @foreach($data['product'] as $product)
                                        @if($product->id == $data['filter_product'])
                                        <option value="{{$product->id}}" selected>{{\App\Models\Item::getTitle($product->item_id)}}</option>
                                        @else
                                        <option value="{{$product->id}}">{{\App\Models\Item::getTitle($product->item_id)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="filter_payment_mode" id="filter_payment_mode" class="form-control">
                                    <option value="">Select Mode</option>
                                    @foreach($data['payment_mode'] as $payment)
                                        @if($payment['id'] == $data['filter_payment_mode'])
                                        <option value="{{$payment['id']}}" selected>{{$payment['title']}}</option>
                                        @else
                                        <option value="{{$payment['id']}}">{{$payment['title']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="filter_status" id="filter_status" class="form-control">
                                    <option value="">Select Status</option>
                                    @foreach($data['status'] as $status)
                                        @if($status['id'] == $data['filter_status'])
                                        <option value="{{$status['id']}}" selected>{{$status['title']}}</option>
                                        @else
                                        <option value="{{$status['id']}}">{{$status['title']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="filter_order_date" id="filter_order_date" class="form-control" placeholder="{{Date('Y-m-d')}}" value="{{$data['filter_order_date']}}">
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="filter_delivery_date" id="filter_delivery_date" class="form-control" placeholder="{{Date('Y-m-d')}}" value="{{$data['filter_delivery_date']}}">
                            </div>
                        </div>
                        <div class="data-tables">
                            <table id="vendor_list" class="table table-bordered text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Unit Cost</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    @php($item = \App\Models\Product::getItemByProductId($order->product_id))
                                    <tr>
                                        <td>{{\App\Models\User::getName($order->customer_id)}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{\App\Models\Product::getProductPrice($order->product_id)}}</td>
                                        <td>{{$order->quantity}}</td>
										<td>{{$order->total_amount}}</td>
                                        <td>{{\App\Models\Order::getOrderPaymentMode($order->payment_mode)}}</td>
                                        <td>{{\App\Models\Order::getOrderStatus($order->status)}}</td>
                                        <td>{{$order->order_date}}</td>
                                        <td>{{$order->delivery_date}}</td>
										<td>
											<form method="post" action="{{route('order.destroy', $order->id)}}">
												{!! csrf_field() !!}
												{!! method_field('DELETE') !!}
												<a href="{{route('order.show', $order->id)}}" class="btn btn-xs btn-info"><i class="ti-eye"></i></a>
												<!-- <a href="{{route('order.edit', $order->id)}}" class="btn btn-xs btn-warning"><i class="ti-pencil-alt"></i></a> -->
												<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="ti-trash"></i></button>
											</form>
										</td>                                   	
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-right">
                            	{{$orders->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </div>
</div>

@endsection
@section('script')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script>
	$('#vendor_list').DataTable({
		paging: false,
	});
</script>
@endsection