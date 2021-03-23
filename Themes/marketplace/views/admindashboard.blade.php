<!DOCTYPE html>
<html>
<head>
     <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <link rel="stylesheet" href="{{ themes('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{themes('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ themes('css/mystyle.css') }}" type="text/css">
    <style>
        .start-header.scroll-on{
            background: #000 !important;
        }
        .start-header.scroll-on .nav-link {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 14px;
        }
    </style>
</head>
<body style="margin:0;">
    <section class="start-header scroll-on">
    <div class="container">
        <div class="row">
            <div class="col-12 header_area">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="/" target="_blank">
                        <img src="<?php echo asset('/').'public'?>/{{$logo}}" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto py-4 py-md-0">
                            <li class="{{ Request::is('/') ? 'active' : '' }} nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a href="/" class="nav-link">Home</a>
                            </li>
                            <li class="{{ Request::is('download') ? 'active' : '' }} nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                                <a href="/download" class="nav-link">Download</a>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
<section class="features" style="padding:0;">
        <div class="container-fluid">
            <div class="row">
<iframe style="width: 100%;height: 100vh;border: 0;" src="https://cms.codequalitytechnologies.com/textla/login"></iframe>
</div>
</div>
</section>
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
