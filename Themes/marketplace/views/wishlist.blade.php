@extends('layouts.master')
@section('content')
<section class="banner" style="padding:5%;">
        <div class="container">
            <div class="row">
                <div class="col-md-9 banner_text">
                    <h1 class="fadeInLeft animated">
                        <h2>My Wishlist</h2>
                    </h1>
                </div>
            </div>
        </div>
    </section>
   

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                @include('layouts.sidebar')
                <div class="col-lg-9 order-1 order-lg-2">
                    @include('part.wishlist')
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
@endsection