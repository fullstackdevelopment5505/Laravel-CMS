@extends('layouts.master')
@section('content')
 <section class="banner" style="padding:5%;">
        <div class="container">
            <div class="row">
                <div class="col-md-9 banner_text">
                    <h1 class="fadeInLeft animated">
                        <h2>Login</h2>
                    </h1>
                </div>
            </div>
        </div>
    </section>
   

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
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
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Login</h2>
                        <form id="login_form" action="/login" method="post" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                            <input type="hidden" id="redirect" name="redirect" value="{{$redirect}}">
                            <div class="group-input">
                                <label for="email">Email address <span class="text-danger">*</span></label>
                                <input type="text" id="email" name="email" required>
                            </div>
                            <div class="group-input">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                                    <a href="/forgot" class="forget-pass">Forget your Password</a>
                                </div>
                            </div>
                            <button type="submit" class="site-btn login-btn">Sign In</button>
                        </form>
                        <div class="switch-login">
                            <a href="/register" class="or-login">Or Create An Account</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
        $("#login_form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },                                        
                password: {
                    required: true
                }
            },
            messages: {
                                                   
            },
         })
    </script> 
    <!-- Register Form Section End -->
@endsection