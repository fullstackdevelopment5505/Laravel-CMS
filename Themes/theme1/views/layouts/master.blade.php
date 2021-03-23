<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CMS</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ themes('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/style.css') }}" type="text/css">
    
    @include('master.common')
</head>
<body class="home-two">
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    @include('layouts.header')
    @yield('content')
    @include('layouts.footer')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="{{ themes('js/bootstrap.min.js') }}"></script>
    <script src="{{ themes('js/jquery-ui.min.js') }}"></script>
    <script src="{{ themes('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ themes('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ themes('js/jquery.zoom.min.js') }}"></script>
    <script src="{{ themes('js/jquery.dd.min.js') }}"></script>
    <script src="{{ themes('js/jquery.slicknav.js') }}"></script>
    <script src="{{ themes('js/owl.carousel.min.js') }}"></script>
    <script src="{{ themes('js/main.js') }}"></script>
</body>
</html>
