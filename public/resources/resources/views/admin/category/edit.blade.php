
@extends('admin.layout.app')
@section('content')
    <div>
        @include('admin.layout.sidebar')
        <div  class="all-content-wrapper">
            @include('admin.layout.header')
            <div class="data-table-area mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="sparkline13-list">
                                <div class="sparkline13-hd">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="main-sparkline13-hd">
                                                <h1>Update Category</h1>
                                            </div>
                                        </div>
                                        <div class="col-md-3 m-b-15 text-right">
                                           <a href="{{url('cms_admin/category')}}" class="btn btn-primary  btn-sm">Back</a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="sparkline13-graph">  
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if (session('warning'))
                                        <div class="alert alert-warning alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            {{ session('warning') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if($errors->any())
                                        {!! implode('', $errors->all('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!&nbsp; </strong>:message</div>')) !!}
                                    @endif                              
                                    <form  action="{{url('cms_admin/category/post-update')}}" method="post" id="category_form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <input type="hidden" value="{{$category->id}}" name="category_id" id="category_id">
                                            <input type="hidden" value="{{$category->category_url}}" name="category_url_old" id="category_url_old">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label" for="password">Select Category</label>
                                                    <select name="parent_id" value="{{$category->parent_id}}" id="parent_id" class="form-control form-control-sm">  
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $data)
                                                            @if ($category->parent_id == $data->id))
                                                                <option value="{{$data->id}}" selected="selected">{{$data->category_name}}</option>
                                                            @else
                                                                <option value="{{$data->id}}">{{$data->category_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label" for="username">Category Name <i class="fa fa-asterisk error"></i></label>
                                                    <input type="text" placeholder="Category Name" title="Please enter you category name" value="{{$category->category_name}}" name="category_name" id="category_name" class="form-control form-control-sm">
                                                    @if ($errors->has('category_name'))
                                                        <span class="help-block small error text-danger">{{ $errors->first('category_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label" for="password">Category Image  <i class="fa fa-asterisk error"></i></label>
                                                    <input type="file" accept="image/*" onchange="loadFile(event)" title="Please select category image" placeholder="Category Image" value="" name="category_url" id="category_url" class="form-control form-control-sm">
                                                    @if ($errors->has('category_url'))
                                                        <span class="help-block small error text-danger">{{ $errors->first('category_url') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <img id="output" src="<?php echo asset('/').'public'?>/{{$category->category_url}}" class="img-preview img-thumbnail img-fluid"/>
                                            </div>
                                            <script src="<?php echo asset('/').'public'?>/admin/js/vendor/jquery-1.12.4.min.js"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
                                            <script>
                                                window.setTimeout(function() {
                                                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                                        $(this).remove();
                                                    });
                                                    $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
                                                        window.location.href=window.location.origin+"/cms_admin/category";
                                                    });
                                                }, 3000);
                                                var loadFile = function(event) {
                                                    var reader = new FileReader();
                                                    reader.onload = function(){
                                                    var output = document.getElementById('output');
                                                    output.src = reader.result;
                                                    };
                                                    reader.readAsDataURL(event.target.files[0]);
                                                };
                                                $("#category_form").validate({
                                                    rules: {
                                                        category_name: {
                                                            required: true,
                                                            maxlength: 50
                                                        }
                                                    },
                                                    messages: {
                                                        category_name: {
                                                            required: "This field is required",
                                                        }                                       
                                                    },
                                                })
                                            </script>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button class="btn btn-success btn-sm" type="submit">Submit</button>
                                                <button class="btn btn-primary btn-sm" type="reset">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
