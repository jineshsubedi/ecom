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


    	$data['status'][] = ['id' => 1, 'title' => 'Order Placed'];
    	$data['status'][] = ['id' => 2, 'title' => 'Order Canceled'];
    	$data['status'][] = ['id' => 3, 'title' => 'Payment Success'];
    	$data['status'][] = ['id' => 4, 'title' => 'Deliver and Paid'];
    	$data['status'][] = ['id' => 5, 'title' => 'Order Complete'];

    	$data['payment_mode'][] = ['id' => 1, 'title' => 'Cash On Deliver'];
    	$data['payment_mode'][] = ['id' => 2, 'title' => 'E-sewa'];

    	$data['product'] = Product::orderBy('id', 'asc')->get();

        $orders = Order::orderBy('id', 'desc')->paginate(20);
        return view('admin.order.index', compact('orders'))->with('data', $data);
    }

    public function create()
    {
    	$data['status'][] = ['id' => 1, 'title' => 'Order Placed'];
    	$data['status'][] = ['id' => 2, 'title' => 'Order Canceled'];
    	$data['status'][] = ['id' => 3, 'title' => 'Payment Success'];
    	$data['status'][] = ['id' => 4, 'title' => 'Deliver and Paid'];
    	$data['status'][] = ['id' => 5, 'title' => 'Order Complete'];

    	$data['payment_mode'][] = ['id' => 1, 'title' => 'Cash On Deliver'];
    	$data['payment_mode'][] = ['id' => 2, 'title' => 'E-sewa'];

    	$data['product'] = Product::orderBy('id', 'asc')->get();

    	return view('admin.order.create')->with('data', $data);
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
    	$this->validate($request, [
    		'customer' => 'required',
    		'customer_id' => 'required',
    		'product_id' => 'required',
    		'quantity' => 'required',
    		'payment_id' => 'required',
    		'order_date' => 'required',
    		'delivery_date' => 'required',
    		'total_amount' => 'required',
    		'status_id' => 'required',
    	]);
    	$order_code = 'Order-'.Carbon::today()->format('ymd').'-'.(Order::where('order_date', Date('Y-m-d'))->count()+1);
    	$data = [
    		'customer_id' => $request->customer_id,
    		'product_id' => $request->product_id,
    		'order_code' => $order_code,
    		'quantity' => $request->quantity,
    		'order_date' => $request->order_date,
    		'delivery_date' => $request->delivery_date,
    		'total_amount' => $request->total_amount,
    		'payment_mode' => $request->payment_id,
    		'status' => $request->status_id,
    	];
    	Order::create($data);
    	alert()->success('Success', 'Order Created!');
        return redirect()->route('order.index');
    }
    public function destroy($id)
    {
    	$order = Order::findOrFail($id);
    	$order->delete();
    	alert()->success('Success', 'Order Deleted!');
        return redirect()->route('order.index');
    }
}
