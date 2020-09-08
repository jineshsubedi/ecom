@extends('layouts.backend.app')
@section('breadcrums')
<div class="breadcrumbs-area clearfix">
    <ul class="breadcrumbs pull-left">
        <li><a href="{{route('product.index')}}">Product</a></li>
        <li><span>Create</span></li>
    </ul>
</div>
@endsection
@section('style')
<link rel="stylesheet" href="{{asset('backend/assets/tagsinput/dist/bootstrap-tagsinput.css')}}">
<style>
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: white;
        background-color: #c79b39;
        padding: 3px;
        border-radius: 3px;
    }
    .bootstrap-tagsinput {
        width:100%;
    }
    select.form-control:not([size]):not([multiple]) {
        height: calc(2.25rem + 4px);
    }
</style>
@endsection
@section('content')
<div class="main-content-inner">
    <!-- sales report area start -->
    <div class="sales-report-area  mb-5">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Edit Product</h4>
                        <p class="text-muted font-14 mb-4">Add detail to Product</p>
                        <form method="post" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="col-form-label required">Item</label>
                            <select name="item_id" class="form-control">
                                <option value="">Select Item</option>
                                @foreach($items as $item)
                                @if($item->id == $product->item_id)
                                <option value="{{$item->id}}" selected>{{$item->title}}</option>
                                @else
                                <option value="{{$item->id}}">{{$item->title}}</option>
                                @endif
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @if ($errors->has('item_id'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('item_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label required">Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                @if($category->id == $product->category_id)
                                <option value="{{$category->id}}" selected>{{$category->title}}</option>
                                @else
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                @endif
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @if ($errors->has('item_id'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('item_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label required">Price</label>
                            <input type="text" name="price" class="form-control" placeholder="Product price" value={{$product->price}}>
                            <div class="text-danger">
                                @if ($errors->has('price'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label required">Description</label>
                            <textarea class="form-control" rows="5" name="description" placeholder="product description">{!! $product->description !!}</textarea>
                            <div class="text-danger">
                                @if ($errors->has('description'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div id="mainMultiFormSection" style="border:1px solid #dfdede; padding: 10px; margin-bottom: 10px; border-radius: 10px;">
                            <div class="row">
                                @foreach($attachments as $attachment)
                                <div class="col-md-2" id="attachment_file{{$attachment->id}}">
                                    <img src="{{asset('images/'.$attachment->file_name)}}" style="width:150px; height:100px; object-fit: contain; background-color:lightgrey;">
                                    <span onclick='removeProductAttachment({{$attachment->id}})'><i class="ti-trash text-danger"></i></span>
                                </div>
                                @endforeach
                            </div>
                            @if(old('image'))
                            @for($i=0; $i < count(old('image')); $i++)
                            <div id="oldForm{{$i}}" class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">Image</label>
                                        <input class="form-control" name="image[]" id="image{{$i}}" type="file" value="{{old('image.'.$i)}}">
                                        <div class="text-danger">
                                            @if ($errors->has('image.'.$i))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('image.'.$i) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-xs btn-danger" type="button" style="margin-top: 40px;" onclick="removeOldForm({{$i}})"><i class="ti-trash"></i></button>
                                </div>
                            </div>
                            @endfor
                            @else
                            <div id="newForm1" class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">Image</label>
                                        <input class="form-control" name="image[]" id="image1" type="file" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-xs btn-danger" type="button" style="margin-top: 40px;" onclick="removeForm(1)"><i class="ti-trash"></i></button>
                                </div>
                            </div>
                            @endif
                        </div>
                                        
                        <div class="form-group">
                            <label for="example-datetime-local-input" class="col-form-label"></label>
                            <button type="submit" class="btn btn-primary btn-xs"><i class="ti-harddrive"></i> Save</button>
                            <button type="button" class="btn btn-warning btn-xs" onclick="addMoreForm()"><i class="ti-harddrive"></i> Add More Product Image</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{asset('backend/assets/tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.log( error );
        } );

    function shuffleSlug(id)
    {
        var data_title = $("#title"+id).val();
        var data_url = data_title.replace(/ /g,"-");
        $('#slug'+id).val(data_url);
    }

    function removeForm(id)
    {
        $('#newForm'+id).remove();
    }

    var count = 1;
    function addMoreForm()
    {
        count++;
        var formHtml = '<div id="newForm'+count+'" class="row"><div class="col-md-10"><div class="form-group"><label for="example-text-input" class="col-form-label">Image</label><input class="form-control" name="image[]" id="image'+count+'" type="file" ></div></div><div class="col-md-2"><button class="btn btn-xs btn-danger" type="button" style="margin-top: 40px;" onclick="removeForm('+count+')"><i class="ti-trash"></i></button></div></div>';

        $('#mainMultiFormSection').append(formHtml);
    }

    function removeOldForm(id)
    {
        $('#oldForm'+id).remove();
    }
</script>
<script>
    var token = $('input[name=\'_token\']').val();
    function removeProductAttachment(id)
    {
        $('#attachment_file'+id).remove();
        $.ajax({
            type: 'GET',
            url: '{{url("/product_attachment/remove")}}',
            data: '_token='+token+'&id='+id,
            success: function(data){
                console.log(data)
            },
            error: function(error){
                console.log(error);
            }
        });
    }
</script>
@endsection