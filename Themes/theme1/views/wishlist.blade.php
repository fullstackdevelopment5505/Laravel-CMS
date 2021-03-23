@extends('layouts.master')
@section('content')
<!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>My Wishlist</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

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