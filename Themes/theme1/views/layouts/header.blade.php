<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    hello@gmail.com
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    +44 00-000-000
                </div>
            </div>
            <div class="ht-right">
                @if($auth_status)
                    <a href="/logout" class="login-panel"><i class="fa fa-sign-out"></i>Logout</a>
                    <a href="/myaccount" class="login-panel"><i class="fa fa-user"></i>{{{ isset(Auth::user()->fullname) ? Auth::user()->fullname  : Auth::user()->email }}}</a>
                @else
                    <a href="/login" class="login-panel"><i class="fa fa-user"></i>Login</a>
                @endif            
                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="/">
                            <img src="<?php echo asset('/').'public'?>/{{$logo}}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <div class="input-group">
                            <input type="text" id="serach" onKeyUp="searchParam(event)" placeholder="What do you need?">
                            <button type="button"><i class="ti-search"></i></button>
                            <script>
                                function searchParam(event){
                                    if(event.keyCode == 13 && window.location.pathname != '/product'){
                                        window.location.href="/product?keyword="+event.target.value;
                                    }else if(event.keyCode == 13 && window.location.pathname == '/product'){
                                        fetch_data();
                                    }
                                }
                                function fetch_data() {
                                    var page = $('#hidden_page').val();
                                    var sort_type = $('.sorting').val();
                                    var query = $("#serach").val();
                                    var category = $("#hidden_category").val();
                                    var minamount = $("#minamount").val();
                                    var maxamount = $("#maxamount").val();
                                    $.ajax({
                                        url: "<?php echo asset('/').'product?page='?>" + page +  "&sorttype=" + sort_type + "&keyword=" + query+"&category="+category+"&maxamount="+maxamount+"&minamount="+minamount,
                                        success: function(data) {
                                            $('#tbody').html('');
                                            $('#tbody').html(data);
                                        }
                                    })
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                        <li class="heart-icon">
                            @if ($auth_status)
                                <a href="/wishlist">
                                    <i class="icon_heart_alt"></i>
                                    <span id="wishlist_count">{{$wishlistcount}}</span>
                                </a>
                            @else
                                <a href="/login">
                                    <i class="icon_heart_alt"></i>
                                </a>
                            @endif
                        </li>
                        <li class="cart-icon">
                            <a href="/cart">
                                <i class="icon_bag_alt"></i>
                                <span id="cart_count">{{$cartcount}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <div class="nav-depart">
                <div class="depart-btn">
                    <i class="ti-menu"></i>
                    <span>All departments</span>
                    <ul class="depart-hover">
                        @foreach ($categories as $category)
                            <li><a href="/product?category={{$category['category_name']}}">{{$category['category_name']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                    <li class="{{ Request::is('product') ? 'active' : '' }}"><a href="/product">Shop</a></li>
                    <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact</a></li>
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>