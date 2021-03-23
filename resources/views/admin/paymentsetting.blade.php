@extends('admin.layout.app')
@section('content')
<div>
    @include('admin.layout.sidebar')
    <div class="all-content-wrapper">
        @include('admin.layout.header')
        <div class="traffic-analysis-area">
            <div class="container-fluid">
                <div class="sparkline13-list">
                <div class="header-panel">
                    <div class="sparkline13-hd">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="main-sparkline13-hd">
                                    <h1>Payment Setting</h1>
                                </div>
                            </div>
                            <div class="col-md-3 m-b-15 text-right">
                                <a href="<?php echo asset('/').'textla/dashboard'?>"
                                    class="btn btn-primary btn-sm">Home</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-panel-body">
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
                    <div class="row">                    
                        <div class="col-md-12">
                        <div class="alert alert-success ">
                               
                               <h4>
                               No payment added
                               </h4>
                               <h5>
                               In order to add payment:
                               </h5>
                               <h5>
                               go to "Add-ons" > Select available payment add-ons. 
                               </h5>

                            </div>

                        </div>
                    </div>                   
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection