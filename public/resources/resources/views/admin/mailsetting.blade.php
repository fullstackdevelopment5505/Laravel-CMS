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
                                        <form  action="{{url('cms_admin/mailsetting/update')}}"   id="mailsetting_form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">

                                            <div class="col-md-6">
                                            
                                                <div class="form-group">
                                                    <label class="control-label" for="smtp_host">SMTP Host</label>
                                                    <input type="text" placeholder="SMTP Host" title="Please enter you smtp Host" value="" name="smtp_host" id="smtp_host" class="form-control form-control-sm">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="control-label" for="smtp_port">SMTP Port</label>
                                                    <input type="text" placeholder="SMTP Port" title="Please enter you smtp Port" value="" name="smtp_port" id="smtp_port" class="form-control form-control-sm">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="smtp_port">SMTP User</label>
                                                    <input type="text" placeholder="SMTP User" title="Please enter you smtp User" value="" name="smtp_user" id="smtp_user" class="form-control form-control-sm">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="smtp_port">SMTP Password</label>
                                                    <input type="text" placeholder="SMTP Password" title="Please enter you smtp Password" value="" name="smtp_password" id="smtp_password" class="form-control form-control-sm">
                                                </div>                                      
                                               
                                            </div>  
                                           
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 text-center">
                                                <button class="btn btn-primary btn-lg" type="submit">Save Changes</button>
                                                
                                            </div>
                                        </div>
                                    </form>
                                      
                                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection