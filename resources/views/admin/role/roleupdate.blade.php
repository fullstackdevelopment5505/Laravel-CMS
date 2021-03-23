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
                            <h3>Role Update</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <ul class="breadcome-menu">
                            <li><a href="<?php echo asset('/').'textla/role'; ?>">Roles</a> <span
                                    class="bread-slash">/</span>
                            </li>
                            <li><span class="bread-blod">Edit</span>
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
                    <form action="{{url('textla/role/update')}}" method="post" id="role_form"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="rolename">Roll Name <span
                                            class="text-danger">*</span></label>
                                    <input type="hidden" placeholder="Role Name" title="Please enter Role Name"
                                        name="id" id="id" value="{{$role->id}}" class="form-control form-control-sm">
                                    <input type="text" placeholder="Role Name" title="Please enter Role Name"
                                        name="rolename" id="rolename" value="{{$role->name}}"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="roledescription">Description</label>
                                    <textarea placeholder="Description" title="Please enter you Description"
                                        name="roledescription" id="roledescription" cols="30" rows="10"
                                        class="form-control form-control-sm">{{$role->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="roledescription">Select permissions <span
                                            class="text-danger">*</span></label>
                                    <input type="text" style="opacity:0;" placeholder="Role Name" name="permissions"
                                        value="{{$role->permissions}}" id="permissions">
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Module Name</th>
                                            <th>Write Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($modules as $module)
                                        <tr>
                                            <th>
                                                <input type="checkbox" class="read_check" access="{{$module->id}}"
                                                    id="check_{{$module->id}}">
                                            </th>
                                            <th>{{$module->module_name}}</th>
                                            <th><input type="checkbox" class="write_check"
                                                    access="{{$module->write_access}}" id="check_write_{{$module->id}}"
                                                    disabled="disabled"></th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary btn-md" type="submit">Update Role</button>
                                <a href="<?php echo asset('/').'textla/role'; ?>" class="btn btn-info btn-sm">Back</a>
                            </div>
                        </div>
                    </form>
                    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
                        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous">
                    </script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js">
                    </script>
                    <script>
                    window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function() {
                            $(this).remove();
                        });
                    }, 3000);

                    function getSelectedPermission() {
                        let premissions = [];
                        $(".read_check").each(function() {
                            if ($(this).prop("checked") == true) {
                                premissions.push($(this).attr("access"));
                            }
                        });
                        $(".write_check").each(function() {
                            if ($(this).prop("checked") == true) {
                                premissions.push($(this).attr("access"));
                            }
                        });
                        $("#permissions").val(premissions.join(","));
                        console.log(premissions);
                    }
                    $(document).ready(function() {
                        $(".read_check").change(function() {
                            if ($(this).prop("checked") == true) {
                                $("#check_write_" + $(this).attr("access")).removeAttr("disabled");
                            } else {
                                $("#check_write_" + $(this).attr("access")).removeAttr("checked");
                                $("#check_write_" + $(this).attr("access")).attr("disabled",
                                "disabled");
                            }
                            getSelectedPermission();
                        });
                        $(".write_check").change(function() {
                            getSelectedPermission();
                        });
                        let permissions = $("#permissions").val();
                        if (permissions) {
                            let permissionsData = permissions.split(",");
                            $(".read_check").each(function() {
                                console.log(jQuery.inArray($(this).attr("access"), permissionsData));
                                if (jQuery.inArray($(this).attr("access"), permissionsData) != -1) {
                                    $(this).attr("checked", "checked");
                                    $("#check_write_" + $(this).attr("access")).removeAttr("disabled");
                                }
                            });
                            $(".write_check").each(function() {
                                if (jQuery.inArray($(this).attr("access"), permissionsData) != -1) {
                                    $(this).attr("checked", "checked");
                                    $(this).removeAttr("disabled");
                                }
                            });
                            console.log(permissionsData);
                        }
                    });

                    $("#role_form").validate({
                        rules: {
                            rolename: {
                                required: true
                            },
                            permissions: {
                                required: true
                            }
                        },
                        messages: {
                            rolename: {
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