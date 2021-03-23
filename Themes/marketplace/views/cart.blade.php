@extends('layouts.master')
@section('content')
<section class="banner" style="padding:5%;">
        <div class="container">
            <div class="row">
                <div class="col-md-9 banner_text">
                    <h1 class="fadeInLeft animated">
                        <h2>Shopping Cart</h2>
                    </h1>
                </div>
            </div>
        </div>
    </section>
   

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row" id="cart-data">
                 @include('part.cart')
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
    
</script>
@endsection