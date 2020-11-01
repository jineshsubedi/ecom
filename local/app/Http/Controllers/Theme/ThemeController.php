<?php

namespace App\Http\Controllers\Theme;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Page;
use App\Models\Item;
use App\Models\Group;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductAttachment;
use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $featured_products = Product::where('featured', 1)->with('product_attachment')->limit(6)->get();
        $new_products = Product::where('new', 1)->with('product_attachment')->limit(6)->get();
        $recomended_products = Product::orderBy('visits','desc')->select('id','title','slug','price')->limit(9)->get()->toArray();
        $recomended_products =array_chunk($recomended_products, 3);
        
        $featured_categories = Category::where('featured', 1)->orderBy('title', 'asc')->get();
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);
        $categories = Category::orderBy('title', 'asc')->with('sub_category')->get();

        $sliders = Slider::orderBy('id', 'desc')->where('active', 0)->get();

    	return view('theme.index', compact('blogs', 'featured_products', 'categories', 'recomended_products', 'featured_categories', 'new_products', 'sliders'));
    }

    public function contact_us()
    {
    	return view('theme.contact');
    }
    public function shop()
    {
        $categories = Category::orderBy('title', 'asc')->with('sub_category')->get();
        $products = Product::orderBy('id', 'desc')
            ->with('product_attachment')
            ->paginate(30);
        $products->map(function($product){
            $product['rate'] = \App\Models\Rating::where('product_id', $product->id)->avg('rate');
            return $product;
        });
    	return view('theme.shop', compact('categories', 'products'));
    }
    public function shop_detail($id)
    {
        $recomended_products = Product::orderBy('visits','desc')->select('id','title','slug','price')->limit(9)->get()->toArray();
        $recomended_products =array_chunk($recomended_products, 3);

        $categories = Category::orderBy('title', 'asc')->with('sub_category')->get();
        $product = Product::where('slug', $id)
            ->orderBy('id', 'desc')
            ->with('product_attachments','product_attachment')
            ->first();

        $ratings = \App\Models\Rating::where('product_id', $product->id)->orderBy('id', 'desc')->get();
        $avg_rating = \App\Models\Rating::where('product_id', $product->id)->avg('rate');
        // return $product;
    	return view('theme.shop_detail', compact('product', 'categories', 'recomended_products', 'avg_rating', 'ratings'));
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
            // $order_code = 'Order-'.Carbon::today()->format('ymd').'-'.(Order::where('order_date', Date('Y-m-d'))->count()+1);
        }

        alert()->success('Success', 'Order Updated!');
        return redirect()->back();
    }
    public function getSubCategoryByCategoryId(Request $request)
    {
        $category = \App\Models\Category::findOrFail($request->category_id);
        $sub_category = \App\Models\SubCategory::where('category_id', $category->id)->orderBy('title', 'asc')->get();
        return $sub_category;
    }
    public function saveRating(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'description' => 'required',
            'rate' => 'required',
        ],[
            'rate.required' => 'You must Rate this product',
        ]);

        $data = [
            'product_id' => $request->product_id,
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'description' => nl2br($request->description),
            'rate' => $request->rate,
        ];
        \App\Models\Rating::create($data);
        alert()->success('Success', 'You have rate this product!');
        return redirect()->back();
    }
    public function deleteRating($id)
    {
        \App\Models\Rating::find($id)->delete();
        alert()->success('Success', 'You have deleted your review');
        return redirect()->back();
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('theme.about', compact('page'));
    }

    public function group($slug)
    {
        $data['group'] = Group::where('slug', $slug)->first();
        $items = $data['group']->category != NULL ? json_decode($data['group']->category) : [0];
        $data['category'] = Category::whereIn('id', $items)->paginate(30);
        $data['category']->map(function($category){
            $category['total_product'] = Category::countProduct($category->id);
            $category['total_sub_category'] = Category::getSubCategory($category->id);
            return $category;
        });
        // return $data;
        return view('theme.group')->with('data', $data);

    }
}
