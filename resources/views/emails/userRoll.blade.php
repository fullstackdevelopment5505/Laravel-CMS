<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome {{$user['fullname']}}</h2>
<br/>
Your Account details <br/>
Full Name is <b> {{$user['fullname']}} ,</b> <br/>
Email-id is <b> {{$user['email']}} ,</b> <br/>
Mobile Number is <b> {{$user['mobile']}} , </b><br/>
Password is <b> {{$user['password']}} , </b><br/>
Roll is <b> {{$user['roll']}} , </b><br/>
Please click on the below link to verify your account
<br/>
<a href="{{url('user/verify', $user->verifyUser->token)}}">Verify Account</a>
</body>
</html>
