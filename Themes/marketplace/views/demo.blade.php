@extends('layouts.master')
@section('content')
     <!-- //Features Screen Image Section -->
    <section class="features demo-feature">
         <div class="container-fluid">
            <div class="row">
        <div class="download-panel text-center text-dark">
                    <h5>Download Textla For Free</h5>
                </div>
                </div>
                </div>
        <div class="container">
            <div class="row">
                
                <div class="col-md-12 section_title">
                    <!--<h2>Run a Textla Demo</h2>-->
                    <p>The features in Textla CMS is the result of a thought process, keeping in mind the interest of eCommerce End-Users, eCommerce
Business Owners as well as the Developers. The features within the solution have been developed with a motive to offer a seamless experience to our valuable Users of Textla CMS. Now, relax and enjoy the usability of Textla CMS.</p>
                </div>

                <div class="col-md-12 ">
                    <div class="row features_area">
                        <div class="col-md-6 features_single animatable fadeInUp" style="border-right: 3px dotted black;padding: 30px;    border-bottom: 3px dotted black;">
                            <div class="feature_image">
                                <img src="{{themes('images/frontend.PNG')}}">
                            </div>
                            
                            <h4>Front-End</h4>
                            
                            <p>The store front features within Textla CMS for a flawless<br/>
shopping experience for End-Users.</p>
                            <a target="_blank" href="/demo/store-front"><img src="{{themes('images/image5.PNG')}}">PREVIEW</a>
                        </div>

                        <div class="col-md-6 features_single animatable fadeInUp" style="padding: 30px;    border-bottom: 3px dotted black;">
                            <div class="feature_image">
                                <img src="{{themes('images/frontend1.PNG')}}">
                            </div>
                            <h4>Back-end</h4>
                            <p>The features within Textla CMS Admin for a hassle-free control<br/>
over the Website.</p>
                            <!--<p>For test admin panel use below credentials: <br/>-->
                            <!--username: admin@gmail.com<br/>-->
                            <!--password: admin123-->
                            <!--</p>-->
                            <a target="_blank" href="/demo/admin-dashboard">  <img src="{{themes('images/image5.PNG')}}">PREVIEW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //Features Screen Image Section -->
     <section class="demo-section1">
         <div class="container">
             <div class="row animatable fadeInUp">
                 <div class="col-md-6 text-center">
                     <h1>Product<br/>Management</h1>
                     <ul>
                         <li>Physical Product Upload</li>
                         <li>Digital Product Upload</li>
                         <li>Manage Product Stock</li>
                         <li>Create Coupons</li>
                         <li> Set Discounts For Products</li>
                     </ul>
                 </div>
                 <div class="col-md-6 text-center">
                      <img src="{{themes('images/sec1.PNG')}}">
                 </div>
             </div>
         </div>
     </section>
     <section class="demo-section2">
         <div class="container">
             <div class="row animatable fadeInUp">
                 <div class="col-md-6 text-center">
                      <img src="{{themes('images/brand.png')}}">
                 </div>
                 <div class="col-md-6 text-center">
                     <h1>Your Brand Image</h1>
                     <ul>
                         <li>Your Domain Name</li>
                         <li>Your Contact Info</li>
                         <li>Simple Logo Replacement</li>
                         <li>Easy Slider Modification</li>
                         <li>Your Social Media Links</li>
                         <li>Your Keyword Data</li>
                     </ul>
                 </div>
                 
             </div>
         </div>
     </section>
     <section class="demo-section3">
         <div class="container">
             <div class="row animatable fadeInUp">
                 
                 <div class="col-md-6 text-center">
                     <h1>Powerful System<br/>Addons</h1>
                     <ul>
                         <li>One Click Purchasing</li>
                         <li>One Click Installation</li>
                         <li>Endless Capibilies</li>
                     </ul>
                 </div>
                 <div class="col-md-6 text-center">
                      <img src="{{themes('images/powerful.png')}}">
                 </div>
             </div>
         </div>
     </section>
     <section class="demo-section4">
          <div class="container">
             <div class="row animatable fadeInUp">
                  <div class="col-md-6">
                      <img class="brand" src="{{themes('images/payment.png')}}">
                 </div>
                 <div class="col-md-6 text-center plg-logos">
                     <h1>Easy To Configure<br/>Payments</h1>
                    <div class="row">
                        <div class="col-md-4 mb-15  pr-0"><div class="panel-card">
                        <img src="{{themes('images/paypal.png')}}">
                        </div></div>
                        <div class="col-md-4 mb-15  pr-0"><div class="panel-card">
                        <img src="{{themes('images/square.png')}}">
                        </div></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-15  pr-0"><div class="panel-card">
                        <img src="{{themes('images/stripe.png')}}">
                        </div></div>
                        <div class="col-md-4 mb-15  pr-0"><div class="panel-card">
                        <img src="{{themes('images/authorize.png')}}">
                        </div></div>
                    </div>
                 </div>
                
             </div>
         </div>
     </section>
     <section class="demo-section5 text-center">
         <a class="animatable fadeInUp" href="/download">
         <button class="btn-download-demo">Download Now</button>
         </a>
     </section>
@endsection