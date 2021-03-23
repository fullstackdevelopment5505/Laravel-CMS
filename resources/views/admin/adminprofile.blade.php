@extends('admin.layout.app')
@section('content')
<div>
    @include('admin.layout.sidebar')
    <div class="all-content-wrapper">
        @include('admin.layout.header')
        <div class="traffic-analysis-area">
            <div class="container-fluid">
                <div class="header-panel">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h3>Profile Update</h3>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu">
                                <li><a href="<?php echo asset('/').'textla/dashboard'; ?>">Home</a> <span
                                        class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">Profile</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="header-panel-body">
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
                    <div class="sparkline13-list">
                        <form action="{{url('textla/adminprofile/update')}}" method="post" id="user_form"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="fullname">Full Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" value="{{$admin->fullname}}" placeholder="Full Name"
                                            title="Please enter Full Name" name="fullname" id="fullname"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="email">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="text" value="{{$admin->email}}" placeholder="Email"
                                            title="Please enter you Email" name="email" id="email"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="mobile">Mobile Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" value="{{$admin->mobile}}" placeholder="Mobile Number"
                                            title="Please enter you Mobile Number" name="mobile" id="mobile"
                                            class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary btn-sm" type="submit">Save Changes</button>
                                    <a href="<?php echo asset('/').'textla/dashboard'; ?>"
                                        class="btn btn-info btn-sm">Back</a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                <a href="javascript:;" data-toggle="modal"  data-target="#adminModal" class="btn btn-md btn-danger">Change Password</a>
                                </div>
                            </div>
                        </form>
                        <script src="<?php echo asset('/').'public'?>/admin/js/vendor/jquery-1.12.4.min.js"></script>
                        <script
                            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js">
                        </script>
                        <script>
                        window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                                $(this).remove();
                            });
                        }, 3000);

                        $("#user_form").validate({
                            rules: {
                                fullname: {
                                    required: true
                                },
                                email: {
                                    required: true,
                                    email: true
                                },
                                mobile: {
                                    required: true
                                }
                            },
                            messages: {
                                fullname: {
                                    required: "This field is required"
                                },
                                email: {
                                    required: "This field is required"

                                },
                                mobile: {
                                    required: "This field is required"
                                }

                            },
                        })
                        $(document).ready(function() {
                            $(document).on('click', '#btnSubmit', function(event){
                                if ($('#newpassword').val() != $('#con_pass').val() && $('#newpassword').val() != '' && $('#con_pass').val() != '') {
                                alert('password did not match');
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            if ($('#oldpassword').val() == $('#newpassword').val() && $('#newpassword').val() !=''&& $('#oldpassword').val() !='') {                
                                alert('Please change password this old password and new password are same !');                               
                                $('#newpassword').focus();
                                event.preventDefault();
                                event.stopPropagation();
                            }  

                            })
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalTitle">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">     
                        <form action="{{url('textla/adminprofile/changepassword')}}" method="post" id="adminpass" >
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="oldpassword" class="control-label">Old Password <span class="text-danger">*</span></label>
                                <input type="password" id="oldpassword" name="oldpassword" required class="form-control form-control-sm">                                
                            </div>
                            <div class="form-group">
                                <label for="newpassword" class="control-label">New Password <span class="text-danger">*</span></label>
                                <input type="password" id="newpassword" name="newpassword" required class="form-control form-control-sm">
                                
                            </div>
                            <div class="form-group">
                                <label for="con_pass" class="control-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" id="con_pass" name="con_pass" required class="form-control form-control-sm">
                               
                            </div>
                            <button type="submit" id="btnSubmit" class="btn btn-primary">Change Password</button>
                        </form>                        
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection