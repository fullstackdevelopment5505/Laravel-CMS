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
                            <h3>Mail Settings</h3>
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
                                        <form  action="{{url('cms_admin/mailsetting/update')}}"  method="post" id="mailsetting_form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="smtp_host">SMTP Host</label>
                                                    <input type="text" placeholder="SMTP Host" title="Please enter you smtp Host" value="{{$configuration['smtp_host']}}" name="smtp_host" id="smtp_host" class="form-control form-control-sm">
                                                </div>   
                                            </div>
                                            <div class="col-md-6">                                             
                                                <div class="form-group">
                                                    <label class="control-label" for="smtp_port">SMTP Port</label>
                                                    <input type="text" placeholder="SMTP Port" title="Please enter you smtp Port" value="{{$configuration['smtp_port']}}" name="smtp_port" id="smtp_port" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="smtp_user">SMTP User</label>
                                                    <input type="text" placeholder="SMTP User" title="Please enter you smtp User" value="{{$configuration['smtp_user']}}" name="smtp_user" id="smtp_user" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" for="smtp_password">SMTP Password</label>
                                                    <input type="text" placeholder="SMTP Password" title="Please enter you smtp Password" value="{{$configuration['smtp_password']}}" name="smtp_password" id="smtp_password" class="form-control form-control-sm">
                                                </div>  
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
                                        }, 3000);
                                        var loadFile = function(event) {
                                            var reader = new FileReader();
                                            reader.onload = function(){
                                            var output = document.getElementById('output');
                                            output.src = reader.result;
                                            };
                                            reader.readAsDataURL(event.target.files[0]);
                                        };  
                                        $("#mailsetting_form").validate({
                                            rules: {
                                                smtp_host: {
                                                    required: true
                                                },
                                                smtp_port:{
                                                    required: true,
                                                    digits: true
                                                },
                                                smtp_port:{
                                                    required: true
                                                },
                                                smtp_port:{
                                                    required: true
                                                }
                                            },
                                            messages: {
                                                smtp_host:{
                                                    required: "This field is required"
                                                },smtp_port:{
                                                    required: "This field is required",
                                                    digits: "Please enter only digits"
                                                },smtp_port:{
                                                    required: "This field is required"
                                                },smtp_port:{
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