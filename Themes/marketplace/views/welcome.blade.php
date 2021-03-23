@extends('layouts.master')
@section('content')
   
    <!-- //Header -->
    <!-- BAnner Section -->
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-9 banner_text">
                    <h1 class="animatable fadeInLeft"><strong>TEXTLA</strong> is a revolution in <br>
                        Content Management Systems.
                    </h1>
                    <p class="animatable fadeInRight">With the myriad of content management systems, eCommerce shopping
                        carts, and extensions that require
                        integration into our innovative approach changes this preconception and allows developers and
                        their clients to
                        easily create an eCommerce website.
                    </p>
                    <a href="/download">Download</a>
                    <a href="/demo">See Demo</a>
                </div>
            </div>
        </div>
    </section>

    <!-- //BAnner Section -->

    <!-- Laptop Screen Image Section -->
    <section class="laptop_screen">
        <div class="container">
            <div class="row">
                <img src="{{themes('images/laptop.png')}}" class="animatable fadeInUp">
            </div>
        </div>
    </section>

    <!-- //Features Screen Image Section -->
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section_title">
                    <h2>How It Work?</h2>
                    <p>Download Textla and Install</p>
                </div>

                <div class="col-md-12 ">
                    <div class="row features_area">
                        <div class="col-md-4 features_single animatable fadeInLeft">
                            <div class="feature_image">
                                <img src="{{themes('images/feature1.png')}}">
                            </div>

                            <h4>Exclusive Design</h4>
                            <p>Take advantage of wonderful themes created to provide you with the best website
                                possible.</p>
                        </div>

                        <div class="col-md-4 features_single animatable fadeInUp">
                            <div class="feature_image">
                                <img src="{{themes('images/feature2.png')}}">
                            </div>
                            <h4>Life Time Supports</h4>
                            <p>Having an issue? Our Technical Support team is here to assist you via email 24/7</p>
                        </div>

                        <div class="col-md-4 features_single animatable fadeInRight">
                            <div class="feature_image">
                                <img src="{{themes('images/feature3.png')}}">
                            </div>
                            <h4>Unlimited Update</h4>
                            <p>As we continue to upgrade our system we will provide upgrades to all clients free of
                                charge</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //Features Screen Image Section -->

    <!-- Unlimited Pages Section -->
    <section class="unlimited_pages">
        <div class="container-fluid">
            <div class="row unlimited_tabs">
                <!-- Nav pills -->
                <ul class="container nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#unlimited_pages">Unlimited Pages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#customizable">Customizable</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#products">Unlimited Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#easy_use">Easy to Use</a>
                    </li>
                </ul>
            </div>
            <!-- Tab panes -->
            <div class="row tab-content">
                <div id="unlimited_pages" class="container tab-pane active">

                    <div class="row unlimited_area">
                        <div class="col-md-6 unlimited_images animatable fadeInLeft">
                            <img src="{{themes('images/img1.jpg')}}">
                        </div>

                        <div class="col-md-6 unlimited_content animatable fadeInRight">
                            <h3>Unlimited Pages</h3>
                            <p>
                                When an unknown printer took a galley of type and scrambled it to make
                                a type specimen book. It has words which don't look even slightly
                                believable. If you are going to use a passage of Lorem Ipsum, you need to
                                be sure there isn't anything embarrassing Many desktop publishing
                                packages and web page editors now use Lorem Ipsum as their default
                                model text, and a search for 'lorem ipsum

                            </p>
                        </div>

                    </div>


                </div>
                <div id="customizable" class="container tab-pane fade">
                    <div class="col-md-12">
                        <div class="row unlimited_area">
                            <div class="col-md-6 unlimited_images animatable fadeInLeft">
                                <img src="{{themes('images/img1.jpg')}}">
                            </div>

                            <div class="col-md-6 unlimited_content animatable fadeInRight">
                                <h3>Customizable</h3>
                                <p>
                                    When an unknown printer took a galley of type and scrambled it to make
                                    a type specimen book. It has words which don't look even slightly
                                    believable. If you are going to use a passage of Lorem Ipsum, you need to
                                    be sure there isn't anything embarrassing Many desktop publishing
                                    packages and web page editors now use Lorem Ipsum as their default
                                    model text, and a search for 'lorem ipsum

                                </p>
                            </div>

                        </div>
                    </div>

                </div>
                <div id="products" class="container tab-pane fade">
                    <div class="col-md-12">
                        <div class="row unlimited_area">
                            <div class="col-md-6 unlimited_images animatable fadeInLeft">
                                <img src="{{themes('images/img1.jpg')}}">
                            </div>

                            <div class="col-md-6 unlimited_content animatable fadeInRight">
                                <h3>Unlimited Products</h3>
                                <p>
                                    When an unknown printer took a galley of type and scrambled it to make
                                    a type specimen book. It has words which don't look even slightly
                                    believable. If you are going to use a passage of Lorem Ipsum, you need to
                                    be sure there isn't anything embarrassing Many desktop publishing
                                    packages and web page editors now use Lorem Ipsum as their default
                                    model text, and a search for 'lorem ipsum

                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <div id="easy_use" class="container tab-pane fade">
                    <div class="col-md-12">
                        <div class="row unlimited_area">
                            <div class="col-md-6 unlimited_images animatable fadeInLeft">
                                <img src="{{themes('images/img1.jpg')}}">
                            </div>

                            <div class="col-md-6 unlimited_content animatable fadeInRight">
                                <h3>Easy to Use</h3>
                                <p>
                                    When an unknown printer took a galley of type and scrambled it to make
                                    a type specimen book. It has words which don't look even slightly
                                    believable. If you are going to use a passage of Lorem Ipsum, you need to
                                    be sure there isn't anything embarrassing Many desktop publishing
                                    packages and web page editors now use Lorem Ipsum as their default
                                    model text, and a search for 'lorem ipsum

                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


        </div>

    </section>

    <!-- //Unlimited Pages Section -->

    <!-- Cart Section -->

    <section class="cart_area">
        <div class="container">
            <div class="row">
                <div class="col-md-7 cart_content animatable fadeInLeft">
                    <h3>Prebuilt Tools Built To Run Your <strong>SUPERSTORE</strong></h3>
                    <p>When an unknown printer took a galley of type and scrambled it to make
                        a type specimen book. It has words which don't look even slightly
                        believable. If you are going to use a passage of Lorem Ipsum, you need to
                        be sure there isn't anything embarrassing
                    </p>

                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i> It is a long established fact that</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i> There are many variations of passages</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i> Contrary to popular belief</li>
                    </ul>

                </div>

                <div class="col-md-5 cart_image animatable fadeInRight">
                    <img src="{{themes('images/cart.png')}}">
                </div>

                <div class="col-md-5 cart_image animatable fadeInLeft">
                    <img src="{{themes('images/support.png')}}">
                </div>

                <div class="col-md-7 cart_content animatable fadeInRight">
                    <h3>Exceptional User Expirences for your <strong>CUSTOMERS</strong></h3>
                    <p>When an unknown printer took a galley of type and scrambled it to make
                        a type specimen book. It has words which don't look even slightly
                        believable. If you are going to use a passage of Lorem Ipsum, you need to
                        be sure there isn't anything embarrassing

                    </p>

                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i> It is a long established fact that</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i> There are many variations of passages</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i> Contrary to popular belief</li>
                    </ul>

                </div>

            </div>
        </div>
    </section>
    <!-- //Cart Section -->

    <!-- Great Features Section -->
    <section class="great_features">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-7">
                    <div class="row section_title left">
                        <h2>Great Features</h2>
                        <p>Built In Features To Make Business Easy.</p>
                    </div>
                    <div class="row great_features_area animatable fadeInLeft">
                        <div class="col-md-6 col-sm-6">
                            <div class="row feature_single bg1">
                                <img src="{{themes('images/4a.png')}}">
                                <h5>Manage Customers</h5>
                                <p>Add, Manage, Import, Export and Delete Customers From Your Site</p>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="row feature_single">
                                <img src="{{themes('images/1a.png')}}">
                                <h5>Manage Customers</h5>
                                <p>Add, Manage, Import, Export and Delete Customers From Your Site</p>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="row feature_single">
                                <img src="{{themes('images/2a.png')}}">
                                <h5>Manage Customers</h5>
                                <p>Add, Manage, Import, Export and Delete Customers From Your Site</p>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="row feature_single">
                                <img src="{{themes('images/3a.png')}}">
                                <h5>Manage Customers</h5>
                                <p>Add, Manage, Import, Export and Delete Customers From Your Site</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-5 col-lg-5 great_images animatable fadeInRight">
                    <img src="{{themes('images/great_pc.png')}}">
                </div>
            </div>
        </div>
    </section>

    <!-- //Great Features Section -->

    <!-- Awesome Themes -->
    <section class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section_title">
                    <h2>Awesome Themes</h2>
                    <p>Mobile Responsive and Quality Designs</p>
                </div>
                <div class="col-sm-12">
                    <div id="aweseme" class="owl-carousel owl_slider">
                        @foreach($onhomes as $row)
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle" src="<?php echo asset('/').'public'?>/{{$row['media_url']}}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Even Better Addons Themes -->
    <section class="addons">
        <div class="container">
            <div class="row">
                <div class="col-md-12 white section_title">
                    <h2>Even Better Addons</h2>
                </div>
                <div class="col-md-12">
                    <div class="row addons_area">
                        <div class="col-md-3 col-sm-6 addon_cols fadeInUp animated">
                            <div class="row addons_single color_1">
                                <h4>PLACE ORDERS ON BACKEND</h4>
                                <h6>$9.99</h6>
                                <p>Addon To Your Textla System Now</p>
                                <img src="{{themes('images/Image_sec_1.png')}}">
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 addon_cols fadeInUp animated">
                            <div class="row addons_single color_2">
                                <h4>SHIPPING INTEGRATIONS</h4>
                                <h6>$9.99</h6>
                                <p>Addon To Your Textla System Now</p>
                                <img src="{{themes('images/Image_sec_2.png')}}">
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 addon_cols fadeInUp animated">
                            <div class="row addons_single color_3">
                                <h4>DETAILED SALES REPORTS</h4>
                                <h6><span>Starting as low as</span>$2.99</h6>
                                <p>Addon To Your Textla System Now</p>
                                <img src="{{themes('images/Image_sec_3.png')}}">
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 addon_cols fadeInUp animated">
                            <div class="row addons_single color_4">
                                <h4>PAYMENT GATEWAYS </h4>
                                <h6>$9.99</h6>
                                <p>Addon To Your Textla System Now</p>
                                <img src="{{themes('images/Image_sec_4.png')}}">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- //Even Better Addons Themes -->

    <!-- Integrate Using -->
    <section class="integrate">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section_title">
                    <h2>Integrate Using</h2>
                </div>

                <div class="col-md-12">
                    <div class="row integrate_area">
                        <div class="col-md-3 col-sm-6 integrate_single fadeInLeft animated">
                            <img src="{{themes('images/Artboard_13.png')}}">
                        </div>
                        <div class="col-md-3 col-sm-6 integrate_single fadeInLeft animated">
                            <img src="{{themes('images/Artboard_9.png')}}">
                        </div>
                        <div class="col-md-3 col-sm-6 integrate_single fadeInright animated">
                            <img src="{{themes('images/Artboard_10.png')}}">
                        </div>

                        <div class="col-md-3 col-sm-6 integrate_single fadeInRight animated">
                            <img src="{{themes('images/Artboard_11.png')}}">
                        </div>

                        <div class="col-md-3 col-sm-6 integrate_single fadeInLeft animated">
                            <img src="{{themes('images/Artboard_12.png')}}">
                        </div>

                        <div class="col-md-3 col-sm-6 integrate_single fadeInLeft animated">
                            <img src="{{themes('images/Artboard_15.png')}}">
                        </div>

                        <div class="col-md-3 col-sm-6 integrate_single fadeInRight animated">
                            <img src="{{themes('images/Artboard_0.png')}}">
                        </div>

                        <div class="col-md-3 col-sm-6 integrate_single fadeInRight animated">
                            <img src="{{themes('images/Artboard_14.png')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //Integrate Using -->

    <!-- //Testi Section -->
    @if(isset($review))
    <section class="testimonials border border-top border-left-0 border-right-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section_title">
                    <h2>People are Saying</h2>
                    <p>Simply dummy text of the printing and typesetting industry. Lorem <br>Ipsum has been the
                        industry's standard dummy</p>
                </div>
                <div class="col-sm-12">
                    <div id="customers-testimonials" class="owl-carousel owl_slider">
                       @foreach($review as $row)
                        <div class="item">
                            <div class="shadow-effect">
                                <img class="img-circle" src="<?php echo asset('/').'public'?>/{{$row->profile}}" alt="">
                                <h5>{{$row->fullname}}</h5>
                                <p>{{$row->review_comment}}</p>
                            </div>
                            <div class="testimonial-name">{{$row->product_name}}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    
    <section class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-md-12 newsletter_content">
                    <img src="{{themes('images/logo.png')}}">
                    <h4>Be In The Know With Quality Knowledge and Useful Information About Textla’s Software, Addons,
                        Themes, and Much More.</h4>

                    <form class="row">
                        <div class="col-12 col-md-7 form-group ">
                            <input placeholder="Enter email address">
                            <button>Started</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection