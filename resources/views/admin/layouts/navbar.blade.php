@php
    $site_settings = \App\Models\Setting::find('1')->first();
@endphp
<!-- Navigation Bar-->
<header id="topnav">
    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <li class="dropdown notification-list">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="https://www.svgrepo.com/show/129839/avatar.svg" alt="user-image" class="rounded-circle">
                       
                    </a>
                    <style>
                        .profile-dropdown{
                            width:unset;
                        }
                    </style>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <a href="{{ route('admin_profile') }}" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>
                                {{Auth::user()->name}}
                            </span>
                        </a>

                        {{-- <div class="dropdown-divider"></div> --}}
                        {{-- <a href="{{ route('database-export-backup') }}" class="dropdown-item notify-item">
                            <i class="fe-database"></i>
                            <span>Export Database</span>
                        </a> --}}

                        <!-- item-->
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ route('admin') }}" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <img class="avatar-lg" src="{{ asset("site_settings/$site_settings->logo") }}"
                            alt="{{ $site_settings->site_name }}" style="height: 50px;">
                    </span>
                    <span class="logo-sm">
                         <span class="logo-sm-text-dark"><img class="avatar-lg" src="{{ asset("site_settings/$site_settings->logo") }}"
                            alt="{{ $site_settings->site_name }}" style="height: 50px;"></span>
                    </span>
                </a>
            </div>

        </div>
    </div>
    <!-- end Topbar -->

    <div class="topbar-menu">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">

                    <li class="has-submenu">
                        <a href="{{ route('admin') }}">
                            <i class="fe-airplay"></i>Dashboard
                        </a>
                    </li>

                    <li
                        class="has-submenu {{ request()->is('admin/categories*') || request()->is('admin/contents*') ? 'active' : '' }}">
                        <a href="#"> <i class="fe-grid"></i>Masters
                            <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li class="has-submenu {{ request()->is('admin/categories*') ? 'active' : '' }}">
                                <a href="{{ route('categories.index') }}">Categories</a>
                            </li>
                           
                            <li class="has-submenu {{ request()->is('admin/product*') ? 'active' : '' }}">
                                <a href="{{ route('product.index') }}">Products</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li
                        class="has-submenu  {{ request()->is('admin/banners*') || request()->is('admin/pages*') || request()->is('admin/faqs*')
                            ? 'active'
                            : '' }}">
                        <a href="#"> <i class="fe-target"></i>CMS
                            <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">

                            <li class="has-submenu {{ request()->is('admin/banners*') ? 'active' : '' }}">
                                <a href="{{ route('banners.index') }}">Banners</a>
                            </li>
                            <li class="has-submenu {{ request()->is('admin/menus*') ? 'active' : '' }}">
                                <a href="{{ route('menus.index') }}">Menus</a>
                            </li>
                            <li class="has-submenu {{ request()->is('admin/about-us*') ? 'active' : '' }}">
                                <a href="{{ route('about-us.index') }}">About Us</a>
                            </li>
                             <li class="has-submenu {{ request()->is('admin/ads*') ? 'active' : '' }}">
                                <a href="{{ route('ads.index') }}">Home Ads</a>
                            </li>
                            <li class="has-submenu {{ request()->is('admin/pages*') ? 'active' : '' }}">
                                <a href="{{ route('pages.index') }}">Pages</a>
                            </li>
                             <li class="has-submenu">
                                <a href="{{ route('testimonial.index') }}">Testimonials</a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="has-submenu {{ request()->is('orders*') ? 'active' : '' }}">
                        <a href="#"> <i class="fe-settings"></i>Orders
                            <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            
                            <li class="{{ request()->is('orders*') ? 'active' : '' }}"><a
                                    href="{{ route('orders.index') }}">Manage Orders</a></li>
                            <li class="{{ request()->is('tele_orders*') ? 'active' : '' }}"><a
                                    href="{{ route('tele_orders.index') }}">Offline Billing</a></li>
                           
                            
                        </ul>
                    </li>
                   
                    <li
                        class="has-submenu {{ request()->is('site-settings*') || request()->is('social-media-settings*') || request()->is('seo-settings*') ? 'active' : '' }}">
                        <a href="#"> <i class="fe-settings"></i>Settings
                            <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li class="{{ request()->is('site-settings*') ? 'active' : '' }}"><a
                                    href="{{ route('site-settings.edit', 1) }}">Site Settings</a></li>
                            <li class="{{ request()->is('social-media-settings*') ? 'active' : '' }}"><a
                                    href="{{ route('social-media-settings.edit', 1) }}">Social Media Settings</a>
                            </li>
                            <li class="{{ request()->is('seo-settings*') ? 'active' : '' }}"><a href="{{ route('seo-settings.index') }}">SEO Settings</a></li>
                        </ul>
                    </li>
            

                </ul>
                <!-- End navigation menu -->

                <div class="clearfix"></div>
            </div>
            <!-- end #navigation -->
        </div>
        <!-- end container -->
    </div>
    <!-- end navbar-custom -->

</header>
<!-- End Navigation Bar-->

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
