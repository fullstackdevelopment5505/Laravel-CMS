@extends('layouts.master')
@section('content')

   <section class="banner" style="padding:5%;">
        <div class="container">
            <div class="row">
                <div class="col-md-9 banner_text">
                    <h1 class="fadeInLeft animated">
                        <h2>Change Password</h2>
                    </h1>
                </div>
            </div>
        </div>
    </section>
   

    <!-- Register Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                @include('layouts.sidebar')
                <div class="col-lg-9 order-1 order-lg-2">
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
                                <p id="smsprint"></p>
                                {{ session('error') }}
                            </div>
                            @endif
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Change Password</h2>
                        <form action="/changepassword" method="post" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                            <div class="group-input">
                                <label for="oldpassword">Old Password <span class="text-danger">*</span></label>
                                <input type="password" id="oldpassword" name="oldpassword" required>
                                <div class="invalid-feedback">
                                    Please Enter Old Password
                                    </div>
                            </div>
                            <div class="group-input">
                                <label for="newpassword">New Password <span class="text-danger">*</span></label>
                                <input type="password" id="newpassword" name="newpassword" required>
                                <div class="invalid-feedback">
                                    Please New Enter Password.
                                    </div>
                            </div>
                            <div class="group-input">
                                <label for="con_pass">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" id="con_pass" name="con_pass" required>
                                <div class="invalid-feedback">
                                    Please Enter Confirm Password.
                                    </div>
                            </div>
                            <button type="submit" class="site-btn register-btn">Change Password</button>
                        </form>                        
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </section>    
            
     
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {           
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            if ($('#newpassword').val() != $('#con_pass').val()) {
                alert('password did not match');
                event.preventDefault();
                event.stopPropagation();
            }
            if ($('#oldpassword').val() == $('#newpassword').val() && $('#newpassword').val() !=''&& $('#oldpassword').val() !='') {                
                alert('Please change password this password allready set!');
                $('#smsprint').text('done');
                $('#newpassword').focus();
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
</script>

    <!-- Register Form Section End -->
@endsection