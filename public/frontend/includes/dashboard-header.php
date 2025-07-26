<?php include 'includes/headerstyles.php'?>
    <body>
        <!-- Header Section Start From Here -->
        <header class="header-wrapper">
            <!-- Header Nav Start -->
            <div class="header-nav">
                <div class="container-fluid">
                    <div class="header-nav-wrapper d-md-flex d-sm-flex d-xl-flex d-lg-flex justify-content-between">
                        <div class="header-static-nav">
                            <p><img src="images/icons/header-icons/right.svg" alt="top-right"> What is <span><a href="#">OPEN BOX?</a></span></p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. </p>
                        </div>
                        <div class="header-menu-nav">
                            <p><img src="images/icons/header-icons/bestdeal.svg" alt=""> Today's deal sale 50% off <a href="category-list.php"><span>SHOP NOW!</span></a></p> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Nav End -->
            <div class="header-top bg-white ptb-30px">
                <div class="container-fluid">
                    <div class="row justify-content-between">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                            <div class="logo">
                                <a href="index.php"><img class="img-responsive" src="images/logo.svg" alt="logo.jpg" /></a>
                            </div>
                        </div>
                        <div class="col-xxl-7 col-xl-7  col-lg-8 col-md-12 col-sm-12 col-12 align-self-center">
                            <div class="header-right-element d-flex">
                                <div class="search-element media-body">
                                    <form class="d-flex" action="search-result.php">
                                        <div class="search-category">
                                             <select>
                                                <option value="0">All categories</option>
                                                <option value="12">Laptop</option>
                                                <option value="13">- - Hot Categories</option>
                                                <option value="19">- - - - Dresses</option>
                                                <option value="20">- - - - Jackets &amp; Coats</option>
                                                <option value="21">- - - - Sweaters</option>
                                                <option value="22">- - - - Jeans</option>
                                                <option value="23">- - - - Blouses &amp; Shirts</option>
                                                <option value="14">- - Outerwear &amp; Jackets</option>
                                                <option value="24">- - - - Basic Jackets</option>
                                                <option value="25">- - - - Real Fur</option>
                                                <option value="26">- - - - Down Coats</option>
                                                <option value="27">- - - - Blazers</option>
                                                <option value="28">- - - - Trench Coats</option>
                                                <option value="15">- - Weddings &amp; Events</option>
                                                <option value="29">- - - - Wedding Dresses</option>
                                                <option value="30">- - - - Evening Dresses</option>
                                                <option value="31">- - - - Prom Dresses</option>
                                                <option value="32">- - - - Bridesmaid Dresses</option>
                                                <option value="33">- - - - Wedding Accessories</option>
                                                <option value="16">- - Bottoms</option>
                                                <option value="34">- - - - Skirts</option>
                                                <option value="35">- - - - Leggings</option>
                                                <option value="36">- - - - Pants &amp; Capris</option>
                                                <option value="37">- - - - Wide Leg Pants</option>
                                                <option value="38">- - - - Shorts</option>
                                                <option value="49">Computer</option>
                                                <option value="50">- - Bottoms</option>
                                                <option value="53">- - - - Skirts</option>
                                                <option value="54">- - - - Leggings</option>
                                                <option value="55">- - - - Jeans</option>
                                                <option value="56">- - - - Pants &amp; Capris</option>
                                                <option value="57">- - - - Shorts</option>
                                                <option value="51">- - Outerwear &amp; Jackets</option>
                                                <option value="58">- - - - Trench</option>
                                                <option value="59">- - - - Genuine Leather</option>
                                                <option value="60">- - - - Parkas</option>
                                                <option value="61">- - - - Down Jackets</option>
                                                <option value="62">- - - - Wool &amp; Blends</option>
                                                <option value="52">- - Underwear &amp; Loungewear</option>
                                                <option value="63">- - - - Boxers</option>
                                                <option value="64">- - - - Briefs</option>
                                                <option value="65">- - - - Long Johns</option>
                                                <option value="66">- - - - Men's Sleep &amp; Lounge</option>
                                                <option value="67">- - - - Pajama Sets</option>
                                                <option value="68">Smartphone</option>
                                                <option value="69">- - Accessories &amp; Parts</option>
                                                <option value="75">- - - - Cables &amp; Adapters</option>
                                                <option value="76">- - - - Batteries</option>
                                                <option value="77">- - - - Chargers</option>
                                                <option value="78">- - - - Bags &amp; Cases</option>
                                                <option value="79">- - - - Electronic Cigarettes</option>
                                                <option value="74">- - Video Games</option>
                                                <option value="100">- - - - Handheld Game Players</option>
                                                <option value="101">- - - - Game Controllers</option>
                                                <option value="102">- - - - Joysticks</option>
                                                <option value="103">- - - - Stickers</option>
                                                <option value="104">Game Consoles</option>
                                                <option value="112">Games &amp; Consoles</option>
                                            </select>
                                        </div>
                                        <input type="text" placeholder="Search Products " />
                                        <button><img src="images/header-search.png" alt=""></button>
                                    </form>
                                </div>
                                <!--Cart info Start -->
                                <div class="header-nav">
                                    <ul class="menu-nav">
                                        <li>
                                            <a href="dashboard-wishlist.php" class="wishlist-bg"><img src="images/icons/header-icons/fav.svg" alt="wishlist"> </a>
                                        </li>
                                        <!-- <li>
                                            <a href="#" class="cart-addon" data-number="3" id="cartitembox"><img src="images/icons/header-icons/cart.svg" alt=""> </a>
                                        </li> -->
                                        <li class="pr-0">
                                            <div class="dropdown">
                                                <a href="#" class="cart-addon" data-number="3" id="cartitembox" id="dropdownMenuButton-2" data-bs-toggle="dropdown"><img src="images/icons/header-icons/cart.svg" alt=""> </a>
                                                <ul class="dropdown-menu animation slideDownIn productitembox" aria-labelledby="dropdownMenuButton-2">
                                                    <?php include 'includes/shopping-cart.php' ?>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="pr-0">
                                            <div class="dropdown">
                                                <button type="button" id="dropdownMenuButton-3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/icons/header-icons/profile.svg" alt="">
                                                </button>

                                                <ul class="dropdown-menu animation slideDownIn" aria-labelledby="dropdownMenuButton-3">
                                                    <div class="login-module pb-2">
                                                        <h4><span><a href="javascript:void()" style="cursor:default!important">Dashboard</a></span></h4>
                                                    </div>
                                                    <li>
                                                        <a href="dashboard-myprofile.php"><img src="images/icons/my-profile.png" alt=""> My Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="dashboard-myorders.php"><img src="images/icons/my-orders.png" alt=""> Orders</a>
                                                    </li>
                                                    <li>
                                                        <a href="dashboard-wishlist.php" data-number="3"><img src="images/icons/my-whishlist.png" alt=""> Wishlist <span>0</span></a>
                                                    </li>
                                                    <li>
                                                        <a href="dashboard-rewards.php"><img src="images/icons/my-rewards.png" alt=""> Rewards Box</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--Cart info End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Nav End -->
            <div class="header-menu bg-blue sticky-nav padding-0px">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 custom-col-2">
                            <div class="header-menu-vertical">
                                <h4 class="menu-title d-lg-block d-md-none">Shop Categories</h4>
                                <h4 class="menu-title d-lg-none d-block"><a data-bs-toggle="offcanvas" href="#categoriesMenu">Shop Categories</a></h4>
                                <ul class="menu-content display-none">
                                    <li class="menu-item">
                                        <a href="#">Electronics <i class="ion-ios-arrow-right"></i></a>
                                        <ul class="sub-menu flex-wrap">
                                            <li>
                                                <a href="category.php">
                                                    <span> <strong> Accessories & Parts</strong></span>
                                                </a>
                                                <ul class="submenu-item">
                                                    <li><a href="category-list.php">Cables & Adapters</a></li>
                                                    <li><a href="category-list.php">Batteries</a></li>
                                                    <li><a href="category-list.php">Chargers</a></li>
                                                    <li><a href="category-list.php">Bags & Cases</a></li>
                                                    <li><a href="category-list.php">Electronic Cigarettes</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="category.php">
                                                    <span><strong>Camera & Photo</strong></span>
                                                </a>
                                                <ul class="submenu-item">
                                                    <li><a href="category-list.php">Digital Cameras</a></li>
                                                    <li><a href="category-list.php">Camcorders</a></li>
                                                    <li><a href="category-list.php">Camera Drones</a></li>
                                                    <li><a href="category-list.php">Action Cameras</a></li>
                                                    <li><a href="category-list.php">Photo Studio Supplie</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="category.php">
                                                    <span><strong>Smart Electronics</strong></span>
                                                </a>
                                                <ul class="submenu-item">
                                                    <li><a href="category-list.php">Wearable Devices</a></li>
                                                    <li><a href="category-list.php">Smart Home Appliances</a></li>
                                                    <li><a href="category-list.php">Smart Remote Controls</a></li>
                                                    <li><a href="category-list.php">Smart Watches</a></li>
                                                    <li><a href="category-list.php">Smart Wristbands</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="category.php">
                                                    <span><strong>Audio & Video</strong></span>
                                                </a>
                                                <ul class="submenu-item">
                                                    <li><a href="category-list.php">Televisions</a></li>
                                                    <li><a href="category-list.php">TV Receivers</a></li>
                                                    <li><a href="category-list.php">Projectors</a></li>
                                                    <li><a href="category-list.php">Audio Amplifier Boards</a></li>
                                                    <li><a href="category-list.php">TV Sticks</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="category.php">
                                                    <span><strong>Portable Audio & Video</strong></span>
                                                </a>
                                                <ul class="submenu-item">
                                                    <li><a href="category-list.php">Headphones</a></li>
                                                    <li><a href="category-list.php">Speakers</a></li>
                                                    <li><a href="category-list.php">MP3 Players</a></li>
                                                    <li><a href="category-list.php">VR/AR Devices</a></li>
                                                    <li><a href="category-list.php">Microphones</a></li>
                                                </ul>
                                            </li>
                                            <!-- <li>
                                                <img src="assets/images/menu-image/banner-mega1.jpg" alt="" />
                                            </li> -->
                                        </ul>
                                        <!-- sub menu -->
                                    </li>
                                    <li class="menu-item">
                                        <a href="category.php">Video Games <i class="ion-ios-arrow-right"></i></a>
                                        <ul class="sub-menu sub-menu-2">
                                            <li>
                                                <ul class="submenu-item">
                                                    <li><a href="category-list.php">Handheld Game Players</a></li>
                                                    <li><a href="category-list.php">Game Controllers</a></li>
                                                    <li><a href="category-list.php">Joysticks</a></li>
                                                    <li><a href="category-list.php">Stickers</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <!-- sub menu -->
                                    </li>
                                    <li class="menu-item"><a href="category-list.php">Televisions</a></li>
                                    <li class="menu-item"><a href="category-list.php">Digital Cameras</a></li>
                                    <li class="menu-item"><a href="category-list.php">Headphones</a></li>
                                    <li class="menu-item"><a href="category-list.php"> Wearable Devices</a></li>
                                    <li class="menu-item"><a href="category-list.php"> Smart Watches</a></li>
                                    <li class="menu-item"><a href="category-list.php"> Game Controllers</a></li>
                                    <li class="menu-item"><a href="category-list.php"> Smart Home Appliances</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="mobilemenu"><a data-bs-toggle="offcanvas" href="#topMenu"><i class="fal fa-bars fa-2x text-white"></i></a></div>
                        <div class="col-xxl-3 col-xl-3 col-lg-9 custom-col-2">
                            <div class="header-horizontal-menu">
                                <ul class="menu-content">
                                    <li class="active menu-dropdown">
                                        <a href="index.php">HOME</a>
                                    </li>
                                    <li class="menu-dropdown">
                                        <a href="category-list.php">PERSONAL CARE</a>
                                    </li>
                                    <li class="menu-dropdown">
                                        <a href="category-list.php">IT Accessories</a>
                                    </li>
                                    <li class="menu-dropdown">
                                        <a href="category-list.php">Smart Wearables</a>
                                    </li>
                                    <li class="menu-dropdown">
                                        <a href="category-list.php">Gaming</a>
                                    </li>
                                    <li class="menu-dropdown">
                                        <a href="category-list.php">Tablets</a>
                                    </li>
                                    <li class="menu-dropdown"><a href="category-list.php">Audio</a></li>
                                    <li><a href="category-list.php">Mobile <small>ACCESSORIES</small></a>
                                    
                                    </li>
                                    <li><a href="category-list.php">CAMERA &  <small>ACCESSORIES</small></a></li>
                                    <li>
                                        <a href="shop-by-brand.php">SHOP BY BRAND</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- header horizontal menu -->
                            <!-- <div class="intro-text-shipping text-end">
                                <div class="free-ship"><a href="#">SHOP BY BRAND</a></div>
                            </div> -->
                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- header menu -->
        </header>
        <!-- Header Section End Here -->  


        <!--mobile menu -start-->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="topMenu" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Main Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fal fa-times-circle fa-lg"></i></button>
        </div>
        <div class="offcanvas-body">
            <div class="card bg-white p-3 mb-3">
                <div class="d-flex">
                    <div class="prfimg"><img src="images/profileimg.jpg" alt=""></div>
                    <div class="prfcontent">
                        <p>Hello</p>
                        <h4>Raghava Sree Raj</h4>
                    </div>
                </div>
            </div>
            <ul id="topmenu">
                <li><a href="#" class="has-arrow">Dashboard Menu</a>
                    <ul>
                        <li><a href="dashboard-myprofile.php"><object data="images/dashboard/dashicon-1.svg" type="image/svg+xml"></object> My Profile</a></li>
                        <li><a href="dashboard-myorders.php"><object data="images/dashboard/dashicon-2.svg" type="image/svg+xml"></object> My Orders</a></li>
                        <li><a href="dashboard-wishlist.php"><object data="images/dashboard/dashicon-3.svg" type="image/svg+xml"></object> My Wishlist</a></li>
                        <li><a href="dashboard-address.php"><object data="images/dashboard/dashicon-4.svg" type="image/svg+xml"></object> Manage Address</a></li>
                        <li><a href="dashboard-reviews.php"><object data="images/dashboard/dashicon-5.svg" type="image/svg+xml"></object> Reviews & Ratings</a></li>
                        <li><a href="dashboard-rewards.php"><object data="images/dashboard/dashicon-6.svg" type="image/svg+xml"></object> Reward's Box</a></li>
                        <li><a href="#"><object data="images/dashboard/dashicon-7.svg" type="image/svg+xml"></object> Contact Us</a></li>
                        <li><a href="index.php"><object data="images/dashboard/dashicon-8.svg" type="image/svg+xml"></object> Logout</a></li>
                    </ul>
                </li>
                <li><a href="index.php">HOME</a></li>
                <li><a href="category-list.php">PERSONAL CARE</a></li>
                <li><a href="category-list.php">IT Accessories</a></li>
                <li><a href="category-list.php">Smart Wearables</a></li>
                <li><a href="category-list.php">Audio</a></li>
                <li><a href="category-list.php">Mobile <small>ACCESSORIES</small></a> </li>
                <li><a href="category-list.php">CAMERA &  <small>ACCESSORIES</small></a></li>
                <li><a href="shop-by-brand.php">SHOP BY BRAND</a></li>
            </ul>
        </div>
        </div>


        <!--mobile menu -start-->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="categoriesMenu" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Categories</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fal fa-times-circle fa-lg"></i></button>
        </div>
        <div class="offcanvas-body">
            <ul id="categoriesmenu">
                <li>
                    <a href="#" class="has-arrow">Accessories & Parts</a>
                    <ul>
                        <li><a href="category-list.php">Cables & Adapters</a></li>
                        <li><a href="category-list.php">Batteries</a></li>
                        <li><a href="category-list.php">Chargers</a></li>
                        <li><a href="category-list.php">Bags & Cases</a></li>
                        <li><a href="category-list.php">Electronic Cigarettes</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow">Camera & Photo </a>
                    <ul>
                        <li><a href="category-list.php">Digital Cameras</a></li>
                        <li><a href="category-list.php">Camcorders</a></li>
                        <li><a href="category-list.php">Camera Drones</a></li>
                        <li><a href="category-list.php">Action Cameras</a></li>
                        <li><a href="category-list.php">Photo Studio Supplie</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow">Smart Electronics</a>
                    <ul>
                        <li><a href="category-list.php">Wearable Devices</a></li>
                        <li><a href="category-list.php">Smart Home Appliances</a></li>
                        <li><a href="category-list.php">Smart Remote Controls</a></li>
                        <li><a href="category-list.php">Smart Watches</a></li>
                        <li><a href="category-list.php">Smart Wristbands</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow">Audio & Video</a>
                    <ul>
                        <li><a href="category-list.php">Televisions</a></li>
                        <li><a href="category-list.php">TV Receivers</a></li>
                        <li><a href="category-list.php">Projectors</a></li>
                        <li><a href="category-list.php">Audio Amplifier Boards</a></li>
                        <li><a href="category-list.php">TV Sticks</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow">Portable Audio & Video</a>
                    <ul>
                        <li><a href="category-list.php">Headphones</a></li>
                        <li><a href="category-list.php">Speakers</a></li>
                        <li><a href="category-list.php">MP3 Players</a></li>
                        <li><a href="category-list.php">VR/AR Devices</a></li>
                        <li><a href="category-list.php">Microphones</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        </div>

        <!--mobile-bottom-menu-->
        <div class="mobile-bottom-menu">
            <ul>
                <li><a data-bs-toggle="offcanvas" href="#categoriesMenu"><i class="icon-grid"></i> Categories</a></li>
                <li><a data-bs-toggle="offcanvas" href="#topMenu"><i class="icon-list"></i>Main Menu</a></li>
                <li><a href="dashboard-myprofile.php"><i class="icon-user"></i>Dashboard</a></li>
                <li><a data-bs-toggle="offcanvas" href="#shoppingCart"><i class="icon-basket"></i>Cart</a></li>
                <li><a href="dashboard-wishlist.php"><i class="icon-heart"></i>Wishlist</a></li>
            </ul>
        </div>


        <!--shopping-cart-->
         <!--mobile menu -start-->
         <div class="offcanvas offcanvas-start" tabindex="-1" id="shoppingCart" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="fas fa-shopping-cart"></i> Shopping Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fal fa-times-circle fa-lg"></i></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="mobileproductitembox">
               <ul>
               <?php include 'includes/shopping-cart.php' ?>
               </ul>
            </div>
        </div>
        </div>