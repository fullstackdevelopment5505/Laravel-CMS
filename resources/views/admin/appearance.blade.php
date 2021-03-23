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
                            <h3>Themes</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="breadcome-menu">
                            <li><a href="<?php echo asset('/').'textla/dashboard'; ?>">Home</a> <span class="bread-slash">/</span>
                                            </li>
                                            <li><span class="bread-blod">All Themes</span>
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
                                @foreach($themes as $theme)   
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="courses-inner res-mg-b-30">
                                        <div class="courses-title">
                                            <h2>{{$theme['name']}} </h2>
                                        </div>                                   
                                        <div class="course-des theme-detail">
                                            <p><span><i class="fa fa-clock"></i></span> <b>Title:</b> {{$theme['title']}}</p>
                                            <p><span><i class="fa fa-clock"></i></span> <b>Version:</b> {{$theme['version']}}</p>
                                            <p><span><i class="fa fa-clock"></i></span> <b>Author:</b> {{$theme['author']}}</p>
                                            <p><span><i class="fa fa-clock"></i></span> <b>Description:</b><br> {{$theme['description']}}</p>
                                        </div>
                                        <div class="product-buttons">
                                            @if ($theme['current_theme'] != 1) 
                                            <a href="<?php echo asset('/').'textla/appearance/apply?theme='.$theme['name'] ?>" class="btn btn-primary btn-sm">Active</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach 
                                <script src="<?php echo asset('/').'public'?>/admin/js/vendor/jquery-1.12.4.min.js"></script>
                                <script>
                                    window.setTimeout(function() {
                                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                            $(this).remove();
                                        });
                                    }, 3000);
                                </script>     
                </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection