<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
    	$data['filter_customer'] = 0;
    	$data['filter_product'] = 0;
    	$data['filter_payment_mode'] = 0;
    	$data['filter_status'] = 0;
    	$data['filter_order_date'] = 0;
    	$data['filter_delivery_date'] = 0;


    	$data['status'][] = ['id' => 'order_pending', 'title' => 'Order Pending'];
    	$data['status'][] = ['id' => 'order_place', 'title' => 'Order Place'];
    	$data['status'][] = ['id' => 'order_cancel', 'title' => 'Order Cancel'];
    	$data['status'][] = ['id' => 'order_success', 'title' => 'Order Delivered'];
    	$data['status'][] = ['id' => 'order_complete', 'title' => 'Order Complete'];

    	$data['payment_mode'][] = ['id' => 1, 'title' => 'Cash On Deliver'];
    	$data['payment_mode'][] = ['id' => 2, 'title' => 'Paypal'];

        $orders = Order::orderBy('id', 'desc')->paginate(20);
        return view('admin.order.index', compact('orders'))->with('data', $data);
    }

    public function create()
    {
    	
    }

    public function customerAutocomplete(Request $request)
    {
    	$results = array();
        $term = $request->term;
        $queries = User::where('name', 'LIKE', $term.'%')
                            ->select('id', 'name')
                            ->where('role','customer')
                            ->groupBy('id','name')
                            ->take(10)
                            ->get();
        
        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->name ];
        }
        return response()->json($results);
    }

    public function store(Request $request)
    {
    	
    }
    public function destroy($id)
    {
    	$order = Order::findOrFail($id);
    	$order->delete();
    	alert()->success('Success', 'Order Deleted!');
        return redirect()->route('order.index');
    }
}
