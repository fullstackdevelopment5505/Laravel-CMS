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
                            <h3>User Update</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="breadcome-menu">
                            <li><a href="<?php echo asset('/').'textla/user'; ?>">User</a> <span
                                    class="bread-slash">/</span>
                            </li>
                            <li><span class="bread-blod">update</span>
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
                    <form action="{{url('textla/userupdate?id=')}}{{$user->id}}" method="post" id="user_form"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="fullname">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{$user->fullname}}" placeholder="Full Name" title="Please enter Full Name"
                                        name="fullname" id="fullname" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{$user->email}}" placeholder="Email" title="Please enter you Email" name="email"
                                        id="email" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="mobile">Mobile Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" value="{{$user->mobile}}" placeholder="Mobile Number"
                                        title="Please enter you Mobile Number" name="mobile" id="mobile"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="smtp_password">User Roll</label>
                                    <select name="userroll" id="userroll" class="form-control form-control-sm">
                                        @foreach($roles as $role).
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary btn-sm" type="submit">Save Changes</button>
                                <a href="<?php echo asset('/').'textla/user'; ?>" class="btn btn-info btn-sm">Back</a>
                            </div>
                        </div>
                    </form>
                    <script src="<?php echo asset('/').'public'?>/admin/js/vendor/jquery-1.12.4.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js">
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
                    </script>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection