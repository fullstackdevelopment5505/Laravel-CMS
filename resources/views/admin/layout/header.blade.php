<div class="container-fluid top-nav">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="logo-pro">
                <a href="#">
                <img class="main-logo" src="img/logo/logo.png" alt="">
                
                </a>
            </div>
        </div>
    </div>
</div>
<div class="header-advance-area">
    <div class="header-top-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header-top-wraper">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="header-right-info">
                                    <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                        <li class="nav-item">
                                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false"
                                                class="nav-link dropdown-toggle">
                                                <img src="<?php echo asset('/').'public'?>/admin/img/product/pro4.jpg" alt="" />
                                                <span class="admin-name">{{{ isset(Auth::user()->fullname) ? Auth::user()->fullname : Auth::user()->email }}}</span>
                                                <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                            </a>
                                            <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                <li><a href="<?php echo asset('/').'textla/adminprofile'?>"><span class="edu-icon edu-user-rounded author-log-ic"></span>My Profile</a></li>
                                                <li><a href="<?php echo asset('/').'textla/logout'?>"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                                    <a href="<?php echo asset('/').'admin/dashboard'?>" aria-expanded="false"><span class="educate-icon educate-event icon-wrap sub-icon-mg"
                                            aria-hidden="true"></span> <span class="mini-click-non">Dashboard</span></a>
                                </li>
                                <li class="{{ Request::is('admin/users') ? 'active' : '' }}">
                                    <a href="<?php echo asset('/').'admin/users'?>" aria-expanded="false">
                                    <span class="educate-icon educate-professor icon-wrap"
                                            aria-hidden="true"></span> <span class="mini-click-non">Users</span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
