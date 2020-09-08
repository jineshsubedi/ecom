<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class MyCustomerController extends Controller
{
    public function index()
    {
    	return view('admin.home');
    }

    public function addCart(Request $request)
    {
    	$this->validate($request, [
    		'product_id' => 'required',
    		'quantity' => 'required',
    		'unit_cost' => 'required',
    	]);
    	$cart = Cart::where('product_id', $request->product_id)->where('customer_id', Auth::user()->id)->first();
    	if(isset($cart->id))
    	{
    		$quantity = $cart->quantity + $request->quantity;
    		$total_cost = $quantity*$request->unit_cost;
    		$data = [
    			'quantity' => $quantity,
    			'total_cost' => $total_cost,
    		];
    		$cart = Cart::find($cart->id)->update($data);
    	}else{
    		$total_cost = $request->quantity > 0 ? $request->quantity*$request->unit_cost : $request->unit_cost;
	    	$data = [
	    		'customer_id' => Auth::user()->id,
	    		'product_id' => $request->product_id,
	    		'quantity' => $request->quantity,
	    		'unit_cost' => $request->unit_cost,
	    		'total_cost' => $total_cost,
	    	];
	    	$cart = Cart::create($data);
    	}
    	

    	$response = array(
            'status' => 'success',
            'value' => $data
        );
        return response()->json($response);
    }

    public function mycart(Request $request)
    {
        // $orders = Cart::where('customer_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(20);
        return view('theme.cart');
    }

    public function myorder(Request $request)
    {
        $orders = Order::where('customer_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(20);
        return view('admin.myorder.index', compact('orders'));
    }

    public function checkout(Request $request)
    {
        
    }
}
