<!-- rts footer one area start -->
    <div class="rts-footer-area-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-two-main-wrapper">
                        <div class="footer-single-wixed-two start">
                            <a href="#" class="logo-area">
                                <img src="{{asset('frontend/assets')}}/images/logo/logo.png" alt="logo-area" class="logo">
                            </a>
                            <p class="disc">
                                Welcome to Madavi Homemade Foods, where tradition meets taste! We take pride in crafting authentic, homemade pickles using time-honored recipes and the finest ingredients.
                            </p>
                            
                            <div class="social-style-dash">
                                <ul>
                                    <li><a href="https://www.facebook.com/madavihomemadefoods" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="https://www.youtube.com/@MadaviFoods" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href="https://www.instagram.com/madavihomemadefoods/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-footer-wized mid pt-5 pt-md-0">
                            <h3 class="footer-title">Our Products</h3>
                            <div class="footer-nav">
                                <ul>
                                    @php
                                            $categories = App\Models\Category::where('status',1)->get();
                                        @endphp
                                        @foreach ($categories as $category)  
                                            <li><a href="{{route('products',$category->slug)}}">{{$category->category}}</a></li>
                                        @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="single-footer-wized mid pt-5 pt-md-0">
                            <h3 class="footer-title">Main Links</h3>
                            <div class="footer-nav">
                                <ul>
                                    <li><a href="{{route('home')}}">Home</a></li>
                                    <li><a href="{{route('about')}}">About Us</a></li>
                                    <li><a href="{{route('products')}}">Products</a></li>
                                    <li><a href="{{route('menu')}}">Menu</a></li>
                                    <li><a href="{{route('contact')}}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-footer-wized mid">
                            <h3 class="footer-title d-none d-md-block">&nbsp;</h3>
                            <div class="footer-nav">
                                <ul>
                                    <li><a href="terms_conditions.php">Terms and Conditions</a></li>
                                    <li><a href="privacy_policy.php">Privacy Policy</a></li>
                                    <li><a href="return_refund.php">Return and Refund Policy</a></li>
                                    <li><a href="disclaimer.php">Disclaimer</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-footer-wized pt-5 pt-md-0">
                            <h3 class="footer-title">Contact Us</h3>
                            <div class="contact-information">
                                <!-- single contact information -->
                                <div class="single-contact-information-area">
                                    <div class="icon-area">
                                        <img src="{{asset('frontend/assets')}}/images/icons/address.svg" alt="icons">
                                    </div>
                                    <div class="information-area">
                                        <p class="disc">
                                           Mehedipatnam, Hyderabad
                                        </p>
                                    </div>
                                </div>
                                <!-- single contact information emd -->
                                <!-- single contact information -->
                                <div class="single-contact-information-area">
                                    <div class="icon-area">
                                        <img src="{{asset('frontend/assets')}}/images/icons/phone.svg" alt="icons">
                                    </div>
                                    <div class="information-area">
                                        <p class="disc">
                                            Call to us <br>
                                            <a href="tel:+919701416696">+91 9701416696</a>
                                        </p>
                                    </div>
                                </div>
                                <!-- single contact information emd -->
                                <!-- single contact information -->
                                <div class="single-contact-information-area">
                                    <div class="icon-area">
                                        <img src="{{asset('frontend/assets')}}/images/icons/email.svg" alt="icons">
                                    </div>
                                    <div class="information-area">
                                        <p class="disc">
                                           Email Us <br>
                                            <span>saikishore227@gmail.com</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- single contact information emd -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts footer area end -->

    <!-- rts copyright area start -->
    <div class="rts-copyright-area-two">
        <div class="container-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-arae-two-wrapper">
                        <p class="disc">
                            Copyright 2025 <a href="#">Madavi Homemade Foods.</a>. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts footer one area end -->

    <!-- WhatsApp Button -->
            <a href="https://wa.me/9701416696" target="_blank" class="whatsapp-button d-none d-md-block">
                <img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png" alt="WhatsApp">
                Order Now
            </a>

            <div class="mobile-btn d-block d-md-none">
            <div class="row p-0">
                <div class="col-12">
                    <a href="https://api.whatsapp.com/send?phone=9701416696&amp;text=Hi" target="_blank" class="ph-btn ph-btn2">
                       <img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png" alt="#"> Order Now
                   </a>
                </div>
            </div>
        </div>

    <script defer src="{{asset('frontend/assets')}}/js/plugins.js"></script>
    <script defer src="{{asset('frontend/assets')}}/js/main.js"></script>
</body>
</html>