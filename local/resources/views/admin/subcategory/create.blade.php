@extends('layouts.backend.app')
@section('breadcrums')
<div class="breadcrumbs-area clearfix">
    <ul class="breadcrumbs pull-left">
        <li><a href="{{route('sub_category.index')}}">Sub Category</a></li>
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
        height: calc(2.25rem + 13px);
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
                        <h4 class="header-title">Create Sub Category</h4>
                        <p class="text-muted font-14 mb-4">Add detail to Sub Category</p>
                        <form method="post" action="{{route('sub_category.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="required">Select Category</label>
                            <select class="form-control" name="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" @if(old('category_id') == $category->id) selected @endif>{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="mainMultiFormSection">
                            @if(old('title'))
                            @for($i=0; $i < count(old('title')); $i++)
                            <div id="oldForm{{$i}}" class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">Title</label>
                                        <input class="form-control" name="title[]" id="title{{$i}}" type="text" value="{{old('title.'.$i)}}">
                                        <div class="text-danger">
                                            @if ($errors->has('title.'.$i))
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $errors->first('title.'.$i) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">Slug</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="button" onclick="shuffleSlug({{$i}})"><i class="ti-control-shuffle"></i></button>
                                            </div>
                                            <input class="form-control" name="slug[]" id="slug{{$i}}" type="text" value="{{old('slug.'.$i)}}">
                                        </div>
                                        <div class="text-danger">
                                                @if ($errors->has('slug.'.$i))
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $errors->first('slug.'.$i) }}</strong>
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
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">Title</label>
                                        <input class="form-control" name="title[]" id="title1" type="text" >
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">Slug</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="button" onclick="shuffleSlug(1)"><i class="ti-control-shuffle"></i></button>
                                            </div>
                                            <input class="form-control" name="slug[]" id="slug1" type="text" >
                                        </div>
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
                            <button type="button" class="btn btn-warning btn-xs" onclick="addMoreForm()"><i class="ti-harddrive"></i> Add More</button>
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
                console.error( error );
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
        var formHtml = '<div id="newForm'+count+'" class="row"><div class="col-md-5"><div class="form-group"><label for="example-text-input" class="col-form-label">Title</label><input class="form-control" name="title[]" id="title'+count+'" type="text" ></div></div><div class="col-md-5"><div class="form-group"><label for="example-text-input" class="col-form-label">Slug</label><div class="input-group"><div class="input-group-prepend"><button class="btn btn-outline-secondary" type="button" onclick="shuffleSlug('+count+')"><i class="ti-control-shuffle"></i></button></div><input class="form-control" name="slug[]" id="slug'+count+'" type="text" ></div></div></div><div class="col-md-2"><button class="btn btn-xs btn-danger" type="button" style="margin-top: 40px;" onclick="removeForm('+count+')"><i class="ti-trash"></i></button></div></div>';

        $('#mainMultiFormSection').append(formHtml);
    }

    function removeOldForm(id)
    {
        $('#oldForm'+id).remove();
    }
</script>
@endsection