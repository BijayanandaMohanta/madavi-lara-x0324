<!-- rts footer one area start -->
@php
    $site_settings = \App\Models\Setting::first();
@endphp
<div class="rts-footer-area-two">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-two-main-wrapper">
                    <div class="footer-single-wixed-two start">
                        <a href="#" class="logo-area">
                            <img src="{{ asset("site_settings/$site_settings->logo") }}" alt="logo-area" class="logo">
                        </a>
                        <p class="disc">
                            {{ $site_settings->welcome_message }}
                        </p>

                        <div class="social-style-dash">
                            <ul>
                                <li><a href="{{ $site_settings->facebook }}" target="_blank"><i
                                            class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="{{ $site_settings->youtube }}" target="_blank"><i
                                            class="fa-brands fa-youtube"></i></a></li>
                                <li><a href="{{ $site_settings->instagram }}" target="_blank"><i
                                            class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-footer-wized mid pt-5 pt-md-0">
                        <h3 class="footer-title">Our Products</h3>
                        <div class="footer-nav">
                            <ul>
                                @php
                                    $categories = App\Models\Category::where('status', 1)->get();
                                @endphp
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('products', $category->slug) }}">{{ $category->category }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="single-footer-wized mid pt-5 pt-md-0">
                        <h3 class="footer-title">Main Links</h3>
                        <div class="footer-nav">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('products') }}">Products</a></li>
                                <li><a href="{{ route('menu') }}">Menu</a></li>
                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-footer-wized mid">
                        <h3 class="footer-title d-none d-md-block">&nbsp;</h3>
                        <div class="footer-nav">
                            <ul>
                                <li><a href="{{ route('terms-and-condition') }}">Terms and Conditions</a></li>
                                <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                                <li><a href="{{ route('return-and-refund-policy') }}">Return and Refund Policy</a></li>
                                <li><a href="{{ route('disclaimer') }}">Disclaimer</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-footer-wized pt-5 pt-md-0">
                        <h3 class="footer-title">Contact Us</h3>
                        <div class="contact-information">
                            <!-- single contact information -->
                            <div class="single-contact-information-area">
                                <div class="icon-area">
                                    <img src="{{ asset('frontend/assets') }}/images/icons/address.svg" alt="icons">
                                </div>
                                <div class="information-area">
                                    <p class="disc">
                                        {{ $site_settings->address }}
                                    </p>
                                </div>
                            </div>
                            <!-- single contact information emd -->
                            <!-- single contact information -->
                            <div class="single-contact-information-area">
                                <div class="icon-area">
                                    <img src="{{ asset('frontend/assets') }}/images/icons/phone.svg" alt="icons">
                                </div>
                                <div class="information-area">
                                    <p class="disc">
                                        Call to us <br>
                                        <a
                                            href="tel:{{ $site_settings->mobile_number }}">{{ $site_settings->mobile_number }}</a>
                                    </p>
                                </div>
                            </div>
                            <!-- single contact information emd -->
                            <!-- single contact information -->
                            <div class="single-contact-information-area">
                                <div class="icon-area">
                                    <img src="{{ asset('frontend/assets') }}/images/icons/email.svg" alt="icons">
                                </div>
                                <div class="information-area">
                                    <p class="disc">
                                        Email Us <br>
                                        <span>{{ $site_settings->email }}</span>
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

<script src="{{ asset('frontend/assets') }}/js/plugins.js"></script>
<script src="{{ asset('frontend/assets') }}/js/main.js"></script>
@yield('scripts')
</body>

</html>
