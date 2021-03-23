@extends('layouts.master')
@section('content')
   <section class="banner" style="padding:10%;">
        <div class="container">
            <div class="row">
                <div class="col-md-9 banner_text download-page">
                    <div>
                        <h2 class="fadeInLeft animated">Sell online with Textla</h2>
                        <h4 class="fadeInLeft animated">Download For Free Today</h4>
                        <form class="row fadeInLeft animated">
                            <div class="col-md-10">
                                <input type="email" placeholder="Enter your email address" class="form-control">
                            </div>
                            <div class="col-md-2 pl-0 text-left">
                                <button type="button" class="btn btn-success btn-download">Download</button>
                            </div>
                        </form>
                        <p class="fadeInLeft animated">Use Textla software for free. Only pay for system addons.<br/>By entering your email, you agree to receive marketing emails from Textla.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                <!--<div class="col-md-12 section_title">-->
                <!--    <h2>How It Work?</h2>-->
                <!--    <p>Download Textla and Install</p>-->
                <!--</div>-->

                <div class="col-md-12 ">
                    <div class="row features_area">
                        <div class="col-md-4 features_single animatable fadeInLeft">
                            <div class="feature_image">
                                <img src="{{themes('images/image1.PNG')}}">
                            </div>
                            <h4>Mobile Responsive<br>Solution</h4>
                            <p>Make your site mobile-responsive from homepage to checkout with any Texla theme.</p>
                        </div>

                        <div class="col-md-4 features_single animatable fadeInUp">
                            <div class="feature_image">
                                <img src="{{themes('images/image2.PNG')}}">
                            </div>
                            <h4>Customizable Themes<br>
and System Addons</h4>
                            <p>No Coding Skills Required. 
Easy to use system for scaling your 
businesses to its maximum 
potential.</p>
                        </div>

                        <div class="col-md-4 features_single animatable fadeInRight">
                            <div class="feature_image">
                                <img src="{{themes('images/image3.PNG')}}">
                            </div>
                            <h4>Powerful Store<br>
Management</h4>
                            <p>Benefit from our built-in SEO. 
Easy manage products, customers, orders, taxes rules, coupon codes, payments, shipping and more.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features">
        <div class="container">
            <div class="row">
                <!--<div class="col-md-12 section_title">-->
                <!--    <h2>How It Work?</h2>-->
                <!--    <p>Download Textla and Install</p>-->
                <!--</div>-->

                <div class="col-md-12 ">
                    <div class="row features_area">
                        <div class="col-md-12 features_single animatable fadeInLeft">
                            <div class="feature_image">
                                <img src="{{themes('images/image4.PNG')}}">
                            </div>
                            <p style="font-size: 16px;font-weight: 800;">“Textla is the cheapest solution to launch your full scale<br>
customizable ecommerce platform. No Monthly Fees, No <br> Commission Rates.”</p>
                            <h4 style="font-size: 14px !important;padding-top: 0px;">-Cody from Textla</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //Features Screen Image Section -->    
@endsection