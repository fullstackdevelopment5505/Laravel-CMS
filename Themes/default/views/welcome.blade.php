@extends('layouts.master')
@section('content')
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="{{ themes('img/hero-1.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Bag,kids</span>
                            <h1>Black friday</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Sale <span>50%</span></h2>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="{{ themes('img/hero-2.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Bag,kids</span>
                            <h1>Black friday</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore</p>
                            <a href="#" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Sale <span>50%</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <div class="banner-section spad">
        <div class="container-fluid">
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img src="<?php echo asset('/').'public'?>/{{$category->media_url}}" alt="">
                        <div class="inner-text">
                            <h4>{{$category['category_name']}}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
     <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-large set-bg" data-setbg="{{ themes('img/products/women-large.jpg') }}">
                        <h2>New Arrival</h2>
                        <a href="/product">Discover More</a>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="product-slider owl-carousel">
                        @foreach($onhomes as $row)
                            @include('part.product_data',['row' => $row])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Deal Of The Week Section start -->
    <div class="hero-items owl-carousel">
    @foreach($ondeal as $row)
    <section class="deal-of-week set-bg spad" data-setbg="<?php echo asset('/').'public'?>/{{$row['media_url']}}">
    <!-- data-setbg="{{ themes('img/time-bg.jpg') }}">    -->    
        <div class="container">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h2>Deal Of The Week</h2>
                    <p>{{$row['deal_description']}}  </p>
                    <div class="product-price"> 
                            {{$currency}}{{$row['deal_price']}}{{$currType}}                       
                        <span>/{{$row['product_name']}}</span>
                    </div>
                </div>
                <input type="hidden" value="{{$row['deal_end_date']}}" class="year">
                <div class="countdown-timer end_deal" id="countdown">
                    <div class="cd-item">
                        <span></span>
                        <p>Days</p>
                    </div>
                    <div class="cd-item">
                        <span></span>
                        <p>Hrs</p>
                    </div>
                    <div class="cd-item">
                        <span></span>
                        <p>Mins</p>
                    </div>
                    <div class="cd-item">
                        <span></span>
                        <p>Secs</p>
                    </div>
                </div>
                
                <a href="/product-detail/{{$row['product_slug']}}"class="primary-btn">Shop Now</a>
            </div>
        </div>       
    </section>
                <script>
                     var datevalue = '{{$row['deal_end_date']}}';                                                   
                    $(".end_deal").countdown(datevalue, function (event) {
                        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hrs</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Mins</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Secs</p> </div>"));
                    });
                    datevalue = '';
                </script>
    @endforeach
    </div>
    <!-- Deal Of The Week Section End -->

    <!-- Man Banner Section Begin -->
    <section class="man-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product-slider owl-carousel">
                        @foreach($onsales as $row)
                            @include('part.product_data',['row' => $row])
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="product-large set-bg m-large" data-setbg="{{ themes('img/products/man-large.jpg') }}">
                        <h2>On Sale</h2>
                        <a href="/product?onsale=1">Discover More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection