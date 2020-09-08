<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\Item;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductAttachment;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(20);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('title','asc')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'item_id' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image.*' => 'required|mimes:jpg,png,jpeg,gif|max:2048',
        ]);
        $item_id = $request->item_id;
        if($request->item_id == 0)
        {
            $data =[
                'title' => $request->title,
                'slug' => $request->slug,
            ];
            $item = \App\Models\Item::create($data);
            $item_id = $item->id;
        }
        $data = [
            'item_id' => $item_id,
            'category_id' => $request->category_id,
            'description' => nl2br($request->description),
            'price' => $request->price,
        ];
        $product = Product::create($data);

        for($i=0;$i<count($request->image);$i++)
        {
            if($request->image)
            {
                $file = $request->image[$i];
                $ext = strtolower($file->getClientOriginalExtension()); 
                $file_name = 'product/'.Str::random(10).strtolower($file->GetClientOriginalName());
                $file->move(DIR_IMAGE.'/product/',$file_name);

                $imageData = [
                    'product_id' => $product->id,
                    'file_name' => $file_name
                ];
                ProductAttachment::create($imageData);
            }
        }

        alert()->success('Success', 'Product Created!');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.view', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('title','asc')->get();
        $items = Item::orderBy('title', 'asc')->get();
        $attachments = ProductAttachment::where('product_id', $product->id)->get();
        return view('admin.product.edit', compact('product', 'items', 'categories','attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'item_id' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image.*' => 'sometimes|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $data = [
            'item_id' => $request->item_id,
            'category_id' => $request->category_id,
            'description' => nl2br($request->description),
            'price' => $request->price,
        ];
        $product = Product::findOrFail($id)->update($data);
        if(isset($request->image))
        {
            for($i=0;$i<count($request->image);$i++)
            {
                if($request->image)
                {
                    $file = $request->image[$i];
                    $ext = strtolower($file->getClientOriginalExtension()); 
                    $file_name = 'product/'.Str::random(10).strtolower($file->GetClientOriginalName());
                    $file->move(DIR_IMAGE.'/product/',$file_name);

                    $imageData = [
                        'product_id' => $id,
                        'file_name' => $file_name
                    ];
                    ProductAttachment::create($imageData);
                }
            }
        }

        alert()->success('Success', 'Product Created!');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $attachments = ProductAttachment::where('product_id', $id)->get();
        foreach($attachments as $attachment)
        {
            if(isset($attachment->file_name)){
                if(File::exists(DIR_IMAGE.$attachment->file_name)) {
                    File::delete(DIR_IMAGE.$attachment->file_name);
                }
            }
            ProductAttachment::find($attachment->id)->delete();
        }
        $product->delete();
        alert()->success('Success', 'Product Deleted Successfully!');
        return redirect()->route('blog.index');
    }

    public function removeAttachment(Request $request)
    {
        $attachment = ProductAttachment::findOrFail($request->id);
        if(isset($attachment->file_name)){
            if(File::exists(DIR_IMAGE.$attachment->file_name)) {
                File::delete(DIR_IMAGE.$attachment->file_name);
            }
        }
        $attachment->delete();
        return $request->id;
    }
}
