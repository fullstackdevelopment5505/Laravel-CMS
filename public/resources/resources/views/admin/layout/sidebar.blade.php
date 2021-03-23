 <div class="left-sidebar-pro">
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <a href="<?php echo asset('/').'cms_admin/dashboard'?>"><img class="main-logo" src="<?php echo asset('/').'public'?>/images/logo.png" alt="" /></a>
            <strong><a href="<?php echo asset('/').'cms_admin/dashboard'?>"><img src="<?php echo asset('/').'public'?>/images/logo.png" alt="" /></a></strong>
        </div>
        <div class="left-custom-menu-adp-wrap comment-scrollbar">
            <nav class="sidebar-nav left-sidebar-menu-pro">
                <ul class="metismenu" id="menu1">
                    
                    <li class="{{ Request::is('cms_admin/dashboard') ? 'active' : '' }}">
                        <a href="<?php echo asset('/').'cms_admin/dashboard'?>" aria-expanded="false"><span class="educate-icon educate-event icon-wrap sub-icon-mg"
                                aria-hidden="true"></span> <span class="mini-click-non">Dashboard</span></a>
                    </li>
                    <li class="{{ Request::is('cms_admin/appearance') ? 'active' : '' }}">
                        <a href="<?php echo asset('/').'cms_admin/appearance'?>" aria-expanded="false">
                        <span class="educate-icon educate-form icon-wrap" aria-hidden="true"></span> <span class="mini-click-non">Appearance</span></a>
                    </li>
                    <li class="{{ Request::is('cms_admin/category') ? 'active' : '' }}">
                        <a href="<?php echo asset('/').'cms_admin/category'?>" aria-expanded="false">
                        <span class="educate-icon educate-professor icon-wrap"
                                aria-hidden="true"></span> <span class="mini-click-non">Category</span></a>
                    </li>
                    <li class="{{ Request::is('cms_admin/users') ? 'active' : '' }}">
                        <a href="<?php echo asset('/').'cms_admin/users'?>" aria-expanded="false">
                        <span class="educate-icon educate-professor icon-wrap"
                                aria-hidden="true"></span> <span class="mini-click-non">Users</span></a>
                    </li>
                   
                    
                    <li class="{{ Request::is('cms_admin/generalsetting') ? 'active' : '' }}">
                            <a class="has-arrow" href="<?php echo asset('/').'cms_admin/generalsetting'?>" aria-expanded="false">  <i class="fa fa-gears"></i> <span class="mini-click-non"> Settings</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                            <li>
                                <a href="<?php echo asset('/').'cms_admin/generalsetting'?>" aria-expanded="false">
                                <i class="fa fa-gears"></i>
                                <span class="mini-click-non">General Settings</span></a>
                            </li>
                            <li class="{{ Request::is('cms_admin/mailsetting') ? 'active' : '' }}">
                                <a href="<?php echo asset('/').'cms_admin/mailsetting'?>" aria-expanded="false">
                                <i class="educate-icon educate-message edu-chat-pro" aria-hidden="true"></i>
                                        <span class="mini-click-non">Mail Settings</span></a>
                            </li>
                           </ul>
                        </li>
                    <li class="{{ Request::is('cms_admin/addmedia') ? 'active' : '' }}">
                            <a class="has-arrow" href="<?php echo asset('/').'cms_admin/addmedia'?>" aria-expanded="false">  <i class="fa fa-gears"></i> <span class="mini-click-non"> Media</span></a>
                            <ul class="submenu-angle" aria-expanded="false">
                            <li>
                                <a href="<?php echo asset('/').'cms_admin/addmedia'?>" aria-expanded="false">
                                <i class="fa fa-gears"></i>
                                <span class="mini-click-non">Library</span></a>
                            </li>
                            <li class="{{ Request::is('cms_admin/addmedia') ? 'active' : '' }}">
                                <a href="<?php echo asset('/').'cms_admin/addmedia'?>" aria-expanded="false">
                                <i class="educate-icon educate-message edu-chat-pro" aria-hidden="true"></i>
                                        <span class="mini-click-non">Add New</span></a>
                            </li>
                           </ul>
                        </li>
                </ul>
            </nav>
        </div>
    </nav>
</div>