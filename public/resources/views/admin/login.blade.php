@extends('admin.layout.app')
@section('content')
    <div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login">
				<h3>PLEASE LOGIN TO APP</h3>
            </div>
        @if (session('status'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('status') }}
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('warning') }}
            </div>
        @endif
        @if($errors->any())
            {!! implode('', $errors->all('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!&nbsp; </strong>:message</div>')) !!}
        @endif
			<div class="content-error">
				<div class="hpanel">
                    <div class="panel-body">
                        <form action="{{url('cms_admin/post-login')}}" method="post"  id="loginForm">
                          {{ csrf_field() }}
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" name="email" placeholder="example@gmail.com" title="Please enter you username" required="" value="" name="username" id="username" class="form-control">
                                @if ($errors->has('email'))
                                <span class="help-block small error text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" name="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                                @if ($errors->has('password'))
                                <span class="help-block small error text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <button class="btn btn-success btn-block loginbtn">Login</button>
                        </form>
                    </div>
                </div>
			</div>
		</div>   
    </div>
@endsection
