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
                            <h3>Role Update</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="breadcome-menu">
                            <li><a href="<?php echo asset('/').'textla/dashboard'; ?>">Home</a> <span class="bread-slash">/</span>
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
                                        <form  action="{{url('textla/role/create')}}"  method="post" id="role_form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="rolename">Roll Name <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Role Name" title="Please enter Role Name"  name="rolename" id="rolename" class="form-control form-control-sm">
                                                </div>  
                                                <div class="form-group">
                                                    <label class="control-label" for="roledescription">Description</label>
                                                    <textarea  placeholder="Description" title="Please enter you Description" name="roledescription" id="roledescription" cols="30" rows="10" class="form-control form-control-sm"></textarea>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">                                             
                                                Select permissions
                                            </div>
                                                                          
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-primary btn-lg" type="submit">Update Role</button>
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
                                        }, 3000);
                                                                                 
                                        $("#role_form").validate({
                                            rules: {
                                                rolename: {
                                                    required: true
                                                }
                                            },
                                            messages: {
                                                rolename:{
                                                    required: "This field is required"
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