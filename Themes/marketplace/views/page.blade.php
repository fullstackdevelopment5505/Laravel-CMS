@extends('layouts.master')
@section('content')
@if(isset($page['media_url']))
<section class="banner" style="background: url(<?php echo asset('/').'public'?>/{{$page['media_url']}});padding:5%;background-size: 100% 100%;">
@else
<section class="banner" style="padding:5%;">
@endif
@if(isset($page))
    <div class="container">
        <div class="row">
            <div class="col-md-9 banner_text">
                <h1 class="fadeInLeft animated">
                    <h2>{{$page['page_title']}}</h2>
                </h1>
            </div>
        </div>
    </div>
</section>
<section class="cart_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 cart_content fadeInLeft animated">
                <?php echo($page['page_description']);?>  
            </div>
        </div>
    </div>
</section>
@else
<div class="container">
        <div class="row">
            <div class="col-md-9 banner_text">
                <h1 class="fadeInLeft animated">
                    <h2>404 Page</h2>
                </h1>
            </div>
        </div>
    </div>
</section>
<section class="cart_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 cart_content fadeInLeft animated">
               No Page Found
            </div>
        </div>
    </div>
</section>
@endif

@endsection