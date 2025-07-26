<footer class="main-footer-two">
    <div class="main-footer-two__bg"
         style="background-image: url({{ asset('main_assets/images/shapes/footer-bg-2.png') }});"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 wow fadeInUp" data-wow-delay="100ms">
                <div class="main-footer-two__about">
                    <a href="#" class="main-footer-two__logo">
                        <img src="{{ asset('main_assets/images/logo.png') }}" alt="abrish" width="180" height="102">
                    </a>
                    <ul class="main-footer-two__info-list mt-1">
                        <li><span class="icon-Location"></span>Arjunganj, Gomti Nagar Extension,<br> Lucknow - 226002
                        </li>
                        <li><span class="icon-Telephone"></span><a href="tel:+919140205691">+91 9140205691</a></li>
                        <li><span class="icon-Email"></span><a href="mailto:alabrish.islamic.academy@gmail.com">alabrish.islamic.academy@gmail.com</a>
                        </li>
                    </ul>
                    <div class="main-footer-two__social">
                        <a href="https://www.facebook.com/profile.php?id=100092261739378" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/alabrish_islamic_academy/?igshid=MWVqNXdoaDJqOThzbg%3D%3D"
                           target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://api.whatsapp.com/send?phone=919140205691" target="_blank"><i
                                class="fab fa-whatsapp"></i></a>
                        <a href="https://www.youtube.com/@AlAbrishIslamicAcademy" target="_blank"><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="200ms">
                <div class="main-footer-two__navmenu main-footer-two__widget01">
                    <h3 class="main-footer-two__title">Quick Links</h3>
                    <ul>
                        <li><a href="{{ route('main.home') }}">Home</a></li>
                        <li><a href="{{ route('main.about_us') }}">About Us</a></li>
                        <li><a href="{{ route('main.courses') }}">Courses</a></li>
                        <li><a href="{{ route('main.faqs') }}">FAQ's</a></li>
                        <li><a href="{{ route('main.blog') }}">Blog</a></li>
                        <li><a href="{{ route('main.contact_us') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 wow fadeInUp" data-wow-delay="300ms">
                <div class="main-footer-two__navmenu main-footer-two__widget02">
                    <h3 class="main-footer-two__title">Privacy Links</h3>
                    <ul>
                        <li><a href="{{ route('main.terms_and_conditions') }}">Terms & Conditions</a></li>
                        <li><a href="{{ route('main.privacy_policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('main.refund_and_cancellation') }}">Refund &amp; Cancellation</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-12 wow fadeInUp" data-wow-delay="400ms">
                <div class="main-footer-two__gallery">
                    <h3 class="main-footer-two__title">Location</h3>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d60805.821309409934!2d83.27434427910156!3d17.727487999999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1533129615073"
                        width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</footer>
<section class="copyright text-center pb-50">
    <section class="copyright text-center pb-100">
        <div class="container wow fadeInUp" data-wow-delay="400ms">
            <p class="copyright__text">Copyright <span class="dynamic-year"></span>alabrishislamicacademy.com All Rights
                Reserved | Design & Developed By <a href="https://thecolourmoon.com/" target="_blank">Colourmoon</a></p>
        </div>
    </section>
</section>


<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
        <div class="logo-box bg-white d-inline-block px-5 py-3 rounded">
            <a href="#" aria-label="logo image"><img src="{{ asset('main_assets/images/logo.png') }}" width="120"
                                                     height="68"
                                                     alt="abrish"/></a>
        </div>
        <div class="mobile-nav__container"></div>
        <ul class="mobile-nav__contact list-unstyled">
            <li>
                <i class="fas fa-envelope"></i>
                <a href="mailto:alabrish.islamic.academy@gmail.com">alabrish.islamic.academy@gmail.com</a>
            </li>
            <li>
                <i class="fa fa-phone-alt"></i>
                <a href="tel:+919140205691">+91 9140205691</a>
            </li>
        </ul>
        <div class="mobile-nav__social">
            <a href="https://www.facebook.com/profile.php?id=100092261739378" target="_blank"><i
                    class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/alabrish_islamic_academy/?igshid=MWVqNXdoaDJqOThzbg%3D%3D"
               target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://api.whatsapp.com/send?phone=919140205691" target="_blank"><i
                    class="fab fa-whatsapp"></i></a>
            <a href="https://www.youtube.com/@AlAbrishIslamicAcademy" target="_blank"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>
<a href="#" class="scroll-top">
    <svg class="scroll-top__circle" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
    </svg>
</a>

<script src="{{ asset('main_assets/vendors/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('main_assets/vendors/jarallax/jarallax.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/nouislider/nouislider.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/odometer/odometer.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/tiny-slider/tiny-slider.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/wnumb/wNumb.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/jquery-circleType/jquery.circleType.js') }}"></script>
<script src="{{ asset('main_assets/vendors/jquery-lettering/jquery.lettering.min.js') }}"></script>
<script src="{{ asset('main_assets/vendors/tilt/tilt.jquery.js') }}"></script>
<script src="{{ asset('main_assets/vendors/wow/wow.js') }}"></script>
<script src="{{ asset('main_assets/vendors/isotope/isotope.js') }}"></script>
<script src="{{ asset('main_assets/vendors/countdown/countdown.min.js') }}"></script>
<script src="{{ asset('main_assets/js/main.js') }}"></script>
<script src="{{ asset('main_assets/js/sticky-sidebar.min.js') }}"></script>
<script src="{{ asset('main_assets/js/intlTelInput.min.js') }}"></script>

<script>
    $('.wsh-icon').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('whsactive');
    });
    $(document).ready(function () {
        $('.readlink').click(function () {
            $('.crsviewbox').toggleClass('expanded', 500);
        })
    });
    $(document).ready(function () {
        $('.showbuybox').click(function (e) {
            e.preventDefault();
            $('.afterbuybox').toggleClass('d-block');
            $('.afterbuybox').fadeToggle(1000);
        });
        var sidebar = new StickySidebar('#sidebar', {
            containerSelector: '#main-content',
            topSpacing: 100,
            bottomSpacing: 0
        });
        if (window.innerWidth < 992) {
            sidebar.destroy();
        } else if (window.innerWidth > 992) {
            sidebar.updateSticky();
        }
    });

    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
        preferredCountries: ["in"],
        allowDropdown: true,
        separateDialCode: true,
        utilsScript: "assets/js/utils.js",
    });

    $(document).ready(function () {
        $("#phone").on('countrychange', function (e, countryData) {
            $("#country_code").val($(".iti__selected-dial-code").text());
        })
    });
</script>
</body>
</html>
