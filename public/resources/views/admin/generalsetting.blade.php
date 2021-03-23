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
                            <h3>General Settings</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="breadcome-menu">
                            <li><a href="<?php echo asset('/').'cms_admin/dashboard'; ?>">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">Settings</span>
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
                                        <form method="post" action="{{url('cms_admin/generalsetting/update')}}" id="generalsetting_form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="site_title">Site Titile</label>
                                                    <input type="text" placeholder="Site Title" title="Please enter you Site Title" value="{{$configuration['site_title']}}" name="site_title" id="site_title" class="form-control form-control-sm">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="site_tagline">Tagline</label>
                                                    <input type="text" placeholder="Tagline" title="Please enter you Site Tagline" value="{{$configuration['site_tagline']}}" name="site_tagline" id="site_tagline" class="form-control form-control-sm">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="site_address">Website Address</label>
                                                    <input type="text" placeholder="Website Address" title="Please enter you Website Address"  value="{{$configuration['site_address']}}" name="site_address" id="site_address" class="form-control form-control-sm">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="administrator_email">Administrator Email</label>
                                                    <input type="text" placeholder="Administrator Email" title="Please enter you Email" value="{{$configuration['administrator_email']}}" name="administrator_email" id="administrator_email" class="form-control form-control-sm">
                                                </div>                                              
                                               <input type="hidden" name="site_logo" id="site_logo" value="{{$configuration['site_logo']}}">
                                            </div>                                            
                                            
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label class="control-label" for="password">Site Logo </label>
                                                    <input type="file" accept="image/*" onchange="loadFile(event)" title="Please select category image" placeholder="Category Image" value="" name="site_logo_file" id="site_logo_file" class="form-control form-control-sm" style="border: 4px dashed #b4b9be;">                                             
                                                   
                                                </div>
                                                <img id="output" src="<?php echo asset('/').'public'?>/{{$configuration['site_logo']}}" class="img-preview img-thumbnail img-fluid" style="width:auto !important;"/>
                                            
                                            
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-primary btn-lg" type="submit">Save Changes</button>
                                                
                                            </div>
                                        </div>
                                    </form>
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
                                        $("#generalsetting_form").validate({
                                            rules: {
                                                site_title: {
                                                    required: true,
                                                    maxlength: 50
                                                },
                                                site_address:{
                                                    required: true,
                                                    url: true
                                                },
                                                administrator_email:{
                                                    required: true,
                                                    email: true
                                                }
                                            },
                                            messages: {
                                                site_title:{
                                                    required: "This field is required"
                                                },site_address:{
                                                    required: "This field is required",
                                                    url: "Please enter valid url"
                                                },administrator_email:{
                                                    required: "This field is required",
                                                    email: "Please enter valid email"
                                                }                                
                                            },
                                        })                                            
                                    </script>
                                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection