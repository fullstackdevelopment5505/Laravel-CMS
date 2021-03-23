@extends('admin.layout.app')
@section('content')
    <div>
        @include('admin.layout.sidebar')
        <div  class="all-content-wrapper">
        @include('admin.layout.header')
             <div class="traffic-analysis-area">
                <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="breadcome-heading">
                            <h3>Media</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="breadcome-menu">
                            <li><a href="<?php echo asset('/').'cms_admin/dashboard'; ?>">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Media</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            @if (session('status'))
                                                <div class="alert alert-success alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    {{ session('status') }}
                                                </div>
                                            @endif    
                                            @if (session('error'))
                                                <div class="alert alert-danger alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    {{ session('error') }}
                                                </div>
                                            @endif 
                                            </div>                                        
                                    </div>
                                    <div class="sparkline13-list"> 
                                        <form  action="{{url('cms_admin/addmedia')}}" id="generalsetting_form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row"> 
                                            <div class="col-md-6">
                                            <label class="control-label" for="password"> Upload New Media </label>
                                            <div class="form-group" style="border: 4px dashed #b4b9be;">
                                                    <input type="file" accept="image/*" onchange="loadFile(event)" title="Please select category image" placeholder="Category Image" value="" name="category_url" id="category_url" class="form-control form-control-sm">                                                                                                
                                                </div>
                                                
                                                <img id="output" src="" class="img-preview img-thumbnail img-fluid"/>
                                            
                                            <script src="<?php echo asset('/').'public'?>/admin/js/vendor/jquery-1.12.4.min.js"></script>
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
                                            <script>                                               
                                                var loadFile = function(event) {
                                                    var reader = new FileReader();
                                                    reader.onload = function(){
                                                    var output = document.getElementById('output');
                                                    output.src = reader.result;
                                                    };
                                                    reader.readAsDataURL(event.target.files[0]);
                                                };                                              
                                            </script>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 text-center">
                                                <button class="btn btn-primary btn-lg" type="submit">Upload Media</button>                                                
                                            </div>
                                        </div>
                                        
                                    </form>
                                      
                                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection