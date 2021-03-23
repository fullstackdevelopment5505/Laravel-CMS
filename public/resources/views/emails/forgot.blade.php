<!DOCTYPE html>
<html>
<head>
    <title>Forgot Email</title>
</head>

<body>
<h2>Welcome to the site {{$user['name']}}</h2>
<br/>
Your registered email-id is {{$user['email']}} , Please click on the below link to and login with your temporary password
</br>
Your temporary password is : <strong>{{$user['password']}}</strong>
<br/>
<a href="{{url('login')}}">Login Now</a>
</body>

</html>

