<?php

namespace App\Http\Controllers\Theme;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductAttachment;
use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy('products.id', 'desc')
            ->with('product_attachment')
            ->paginate(10);
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);

        $featured_cats = Category::where('featured', 1)->limit(3)->get();
    	return view('theme.index', compact('products', 'blogs', 'featured_cats'));
    }

    public function about_us()
    {
    	return view('theme.about');
    }
    public function contact_us()
    {
    	return view('theme.contact');
    }
    public function shop()
    {
        $categories = Category::orderBy('title', 'asc')->limit(30)->get();
        $products = Product::leftjoin('items','items.id','products.item_id')
            ->select('products.*','items.title as item_name', 'items.slug as item_slug')
            ->orderBy('products.id', 'desc')
            ->with('product_attachment')
            ->paginate(10);
    	return view('theme.shop', compact('categories', 'products'));
    }
    public function shop_detail($id)
    {
        $product = Product::leftjoin('items','items.id','products.item_id')
            ->where('items.slug', $id)
            ->select('products.*','items.title as item_name', 'items.slug as item_slug')
            ->orderBy('products.id', 'desc')
            ->with('product_attachments')
            ->first();
        // return $product;
    	return view('theme.shop_detail', compact('product'));
    }
    public function cart()
    {
        $data = Cart::leftjoin('products', function($join){
            $join->on('carts.product_id', '=', 'products.id');
        })->leftjoin('items', function($join){
            $join->on('products.item_id','=','items.id');
        })->where('carts.customer_id', Auth::user()->id)
        ->select('carts.id','carts.product_id', 'carts.customer_id','carts.quantity','carts.unit_cost','carts.total_cost','items.title as item_name', DB::raw('(select file_name from product_attachments where product_id  =   carts.product_id  order by id asc limit 1) as photo')  )
        ->groupBy('carts.id','carts.product_id', 'carts.customer_id','carts.quantity','carts.unit_cost','carts.total_cost', 'items.title');

        $cart = $data->get();

        $count = count($cart);

        $total = Cart::where('customer_id', Auth::user()->id)->sum('total_cost');
        $mycart = array(
            'cart' => $cart,
            'count' => $count,
            'total' => $total
        );
        // return $mycart;
    	return view('theme.cart', compact('mycart'));
    }
    public function checkout()
    {
    	return view('theme.checkout');
    }
    public function view_blog($slug)
    {
        return 'view blog';
    }
    public function send_message(Request $request)
    {
    	$data = [
    		'name' => $request->name,
    		'email' => $request->email,
    		'phone' => $request->phone,
    		'subject' => $request->subject,
    		'message' => $request->message,
    	];
    	\App\Models\Contact::create($data);
    	alert()->success('Success', 'Thank You For Messaging Us! We soon contact you.');
    	return redirect()->back();
    }

    public function getMyCart(Request $request)
    {
        $data = Cart::leftjoin('products', function($join){
            $join->on('carts.product_id', '=', 'products.id');
        })->leftjoin('items', function($join){
            $join->on('products.item_id','=','items.id');
        })->where('carts.customer_id', Auth::user()->id)
        ->select('carts.id','carts.product_id', 'carts.customer_id','carts.quantity','carts.unit_cost','carts.total_cost','items.title as item_name', DB::raw('(select file_name from product_attachments where product_id  =   carts.product_id  order by id asc limit 1) as photo')  )
        ->groupBy('carts.id','carts.product_id', 'carts.customer_id','carts.quantity','carts.unit_cost','carts.total_cost', 'items.title');

        $cart = $data->get();

        $count = count($cart);

        $total = Cart::where('customer_id', Auth::user()->id)->sum('total_cost');
        $response = array(
            'status' => 'success',
            'cart' => $cart,
            'count' => $count,
            'total' => $total
        );
        return response()->json($response);
    }

    public function cartRemoveItem(Request $request)
    {
        $cart = Cart::findOrFail($request->id);
        $cart->delete();
        return $request->id;
    }

    public function updateCart(Request $request)
    {
        $this->validate($request, [
            'cart.*' => 'required|integer',
            'quantity.*' => 'required'
        ]);
        // return $request->all();
        $count = count($request->cart);
        for($i=0;$i<$count;$i++)
        {
            $cart = Cart::find($request->cart[$i]);
            if(!isset($cart->id)){
                alert()->error('Failed', 'Update Cart Failed');
                return redirect()->back();
            }
            $total_cost = $cart->unit_cost * $request->quantity[$i];
            $cart->update(['quantity' => $request->quantity[$i], 'total_cost' => $total_cost]);
            $order_code = 'Order-'.Carbon::today()->format('ymd').'-'.(Order::where('order_date', Date('Y-m-d'))->count()+1);
            Order::create([
                'customer_id' => $cart->customer_id,
                'product_id' => $cart->product_id,
                'order_code' => $order_code,
                'quantity' => $cart->quantity,
                'total_amount' => $cart->total_cost,
                'order_date' => Date('Y-m-d'),
            ]);
        }
        Cart::where('customer_id', Auth::user()->id)->delete();

        alert()->success('Success', 'Order Created!');
        return redirect()->route('myorder');
    }
    public function getSubCategoryByCategoryId(Request $request)
    {
        $category = \App\Models\Category::findOrFail($request->category_id);
        $sub_category = \App\Models\SubCategory::where('category_id', $category->id)->orderBy('title', 'asc')->get();
        return $sub_category;
    }
}
