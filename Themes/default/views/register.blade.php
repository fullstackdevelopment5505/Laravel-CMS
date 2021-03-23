@extends('layouts.master')
@section('content')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Register</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
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
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Register</h2>
                        <form action="/register" id="register_form" method="post" class="needs-validation" novalidate>
                        {{ csrf_field() }}
                            <div class="group-input">
                                <label for="username">Fullname <span class="text-danger">*</span></label>
                                <input type="text" id="fullname" name="fullname" required>
                            </div>
                            <div class="group-input">
                                <label for="mobile">Mobile <span class="text-danger">*</span></label>
                                <input type="text" id="mobile" name="mobile" required>
                            </div>
                            <div class="group-input">
                                <label for="username">Email address <span class="text-danger">*</span></label>
                                <input type="text" id="username" name="username" required>
                            </div>
                            <div class="group-input">
                                <label for="pass">Password <span class="text-danger">*</span></label>
                                <input type="password" id="pass" name="pass" required>
                            </div>
                            <button type="submit" class="site-btn register-btn">REGISTER</button>
                        </form>
                        <div class="switch-login">
                            <a href="/login" class="or-login">Or Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
        $("#register_form").validate({
            rules: {
                fullname: {
                    required: true,
                    maxlength: 50
                }, 
                username: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{url('validate-email')}}",
                        type: "post",
                        beforeSend: function (xhr) { // Add this line
                            xhr.setRequestHeader('X-CSRF-Token', $('[name="_token"]').val());
                        },
                        data: {
                            email: function() {
                            return $("#username").val();
                            }
                        }
                    }
                },                                        
                pass: {
                    required: true
                },
                mobile:{
                    required: true,
                    digits:true
                }
            },
            messages: {
                username:{
                    remote: "Sorry, that email is already registered."
                }                                    
            },
         })
    </script>                         
<!-- <script>
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
            if ($('#pass').val() != $('#con_pass').val()) {
                alert('password did not match');
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
</script> -->

    <!-- Register Form Section End -->
@endsection