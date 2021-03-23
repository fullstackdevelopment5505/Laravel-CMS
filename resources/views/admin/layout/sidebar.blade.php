 <div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="<?php echo asset('/').'textla/dashboard'?>">
            
            <img width="170px" src="<?php echo asset('/').'public'?>/images/logo.png" alt="" /></a>
            <strong><a href="<?php echo asset('/').'textla/dashboard'?>">
            <img src="<?php echo asset('/').'public'?>/images/logo.png" alt="" width="170px" /></a></strong>

          
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                    
                    <li class="{{ Request::is('textla/dashboard') ? 'active' : '' }}">
                        <a href="<?php echo asset('/').'textla/dashboard'?>" aria-expanded="false"><span class="educate-icon educate-event icon-wrap sub-icon-mg"
                                aria-hidden="true"></span> <span class="mini-click-non">Dashboard</span></a>
                    </li>
                    <li class="{{ Request::is('textla/appearance') ? 'active' : '' }}">
                        <a href="<?php echo asset('/').'textla/appearance'?>" aria-expanded="false">
                        <span class="educate-icon educate-form icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Appearance</span></a>
                    </li>
                    <li class="{{ Request::is('textla/category') ? 'active' : '' }}">
                        <a href="<?php echo asset('/').'textla/category'?>" aria-expanded="false">
                        <span class="educate-icon educate-professor icon-wrap"
                                aria-hidden="true"></span> <span class="mini-click-non">Category</span></a>
                    </li>
                    <li class="{{ Request::is('textla/product') ? 'active' : '' }}">
                        <a href="<?php echo asset('/').'textla/product'?>" aria-expanded="false">
                        <span class="educate-icon educate-pages icon-wrap"
                                aria-hidden="true"></span> <span class="mini-click-non">Product</span></a>
                    </li>
                    <li class="{{ Request::is('textla/customer') ? 'active' : '' }}">
                        <a href="<?php echo asset('/').'textla/customer'?>" aria-expanded="false">
                        <span class="educate-icon educate-professor icon-wrap"
                                aria-hidden="true"></span> <span class="mini-click-non">Customer</span></a>
                    </li>
                    <li class="{{ Request::is('textla/generalsetting') ? 'active' : '' }}">
                            <a class="has-arrow" href="<?php echo asset('/').'textla/generalsetting'?>" aria-expanded="false">  <i class="fa fa-gears"></i> <span class="mini-click-non"> Settings</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                            <li>
                                <a href="<?php echo asset('/').'textla/generalsetting'?>" aria-expanded="false">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <span class="mini-click-non">General Settings</span></a>
                            </li>
                            <li class="{{ Request::is('textla/mailsetting') ? 'active' : '' }}">
                                <a href="<?php echo asset('/').'textla/mailsetting'?>" aria-expanded="false">
                                <i class="educate-icon educate-message edu-chat-pro" aria-hidden="true"></i>
                                        <span class="mini-click-non">Mail Settings</span></a>
                            </li>
                            <li class="{{ Request::is('textla/currency') ? 'active' : '' }}">
                                <a href="<?php echo asset('/').'textla/currency'?>" aria-expanded="false">
                                <i class="fa fa-money" aria-hidden="true"></i>
                                        <span class="mini-click-non">Currency</span></a>
                            </li>
                            <li class="{{ Request::is('textla/paymentsetting') ? 'active' : '' }}">
                            <a href="<?php echo asset('/').'textla/paymentsetting'?>" aria-expanded="false">
                             <i class="fa fa-credit-card"></i>&nbsp;<span class="mini-click-non">Payment Setting</span></a>
                        </li>
                           </ul>
                        </li>
                        <li class="{{ Request::is('textla/media') ? 'active' : '' }}">
                            <a href="<?php echo asset('/').'textla/media'?>" aria-expanded="false">
                             <i class="fa fa-camera"></i>&nbsp;<span class="mini-click-non">Media</span></a>
                        </li>
                        <li class="{{ Request::is('textla/page') ? 'active' : '' }}">
                            <a href="<?php echo asset('/').'textla/page'?>" aria-expanded="false">
                             <i class="fa fa-file-text"></i>&nbsp;<span class="mini-click-non">Pages</span></a>
                        </li>
                        <li class="{{ Request::is('textla/orderlist') ? 'active' : '' }}">
                            <a href="<?php echo asset('/').'textla/orderlist'?>" aria-expanded="false">
                             <i class="fa fa-shopping-bag"></i>&nbsp;<span class="mini-click-non">Orders</span></a>
                        </li>
                        <li class="{{ Request::is('textla/add-ons') ? 'active' : '' }}">
                            <a href="<?php echo asset('/').'textla/add-ons'?>" aria-expanded="false">
                             <i class="fa fa-plus-square"></i>&nbsp;<span class="mini-click-non">Add-ons</span></a>
                        </li>                      
                        <li class="{{ Request::is('textla/role') ? 'active' : '' }}">
                            <a href="<?php echo asset('/').'textla/role'?>" aria-expanded="false">
                             <i class="fa fa-graduation-cap"></i>&nbsp;<span class="mini-click-non">Role Management</span></a>
                        </li>
                        <li class="{{ Request::is('textla/user') ? 'active' : '' }}">
                            <a href="<?php echo asset('/').'textla/user'?>" aria-expanded="false">
                             <i class="fa fa-users"></i>&nbsp;<span class="mini-click-non">User Management</span></a>
                        </li>
                        <li class="{{ Request::is('textla/contactMessage') ? 'active' : '' }}">
                            <a href="<?php echo asset('/').'textla/contactMessage'?>" aria-expanded="false">
                             <i class="fa fa-commenting-o"></i>&nbsp;<span class="mini-click-non">Contact Messages</span></a>
                        </li>
                        @foreach($addonslist as $row)
                        <li class="{{ Request::is($row->admin_route_param) ? 'active' : '' }}">
                            <a href="<?php echo asset('/').$row->admin_route_param ?>" aria-expanded="false">
                             <i class="fa fa-commenting-o"></i>&nbsp;<span class="mini-click-non">{{$row->admin_route}}</span></a>
                        </li>
                        @endforeach
                </ul>
            </nav>
        </div>
    </nav>
</div>