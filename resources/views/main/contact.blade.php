@extends('main.layouts.main')
@section('title', 'Contact Us')
@section('content')
    <section class="page-header @@extraClassName" data-jarallax data-speed="0.3" data-imgPosition="50% -100%">
        <div class="page-header__bg jarallax-img"></div>
        <div class="page-header__overlay"></div>
        <div class="container text-center">
            <h2 class="page-header__title">@yield('title')</h2>
            <ul class="page-header__breadcrumb list-unstyled">
                <li><a href="{{ route('main.home') }}">Home</a></li>
                <li><span>@yield('title')</span></li>
            </ul>
        </div>
    </section>
    <!-- Contact Start -->

    <!-- Info Start -->
    <section class="contact-info">
        <div class="container">
            <ul class="contact-info__wrapper">
                <li>
                    <div class="contact-info__icon"><span class="icon-Call"></span></div>
                    <p class="contact-info__title">Have any question?</p>
                    <h4 class="contact-info__text"><a href="tel:1234567890">1234567890</a></h4>
                </li>
                <li class="active">
                    <div class="contact-info__icon"><span class="icon-Email"></span></div>
                    <p class="contact-info__title">Send Email</p>
                    <h4 class="contact-info__text"><a href="mailto:info@abrish.com">info@abrish.com</a></h4>
                </li>
                <li>
                    <div class="contact-info__icon"><span class="icon-Location"></span></div>
                    <p class="contact-info__title">Address</p>
                    <h4 class="contact-info__text">Dwarakanagar, Visakhapatnam</h4>
                </li>
            </ul>
        </div>
    </section>
    <!-- Info End -->
    <section class="contact-one">
        <div class="container wow fadeInUp" data-wow-delay="300ms">
            <div class="section-title  text-center">
                <h5 class="section-title__tagline">
                    Contact with Us
                    <svg class="arrow-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55 13">
                        <g clip-path="url(#clip0_324_36194)">
                            <path
                                d="M10.5406 6.49995L0.700562 12.1799V8.56995L4.29056 6.49995L0.700562 4.42995V0.819946L10.5406 6.49995Z"/>
                            <path
                                d="M25.1706 6.49995L15.3306 12.1799V8.56995L18.9206 6.49995L15.3306 4.42995V0.819946L25.1706 6.49995Z"/>
                            <path
                                d="M39.7906 6.49995L29.9506 12.1799V8.56995L33.5406 6.49995L29.9506 4.42995V0.819946L39.7906 6.49995Z"/>
                            <path
                                d="M54.4206 6.49995L44.5806 12.1799V8.56995L48.1706 6.49995L44.5806 4.42995V0.819946L54.4206 6.49995Z"/>
                        </g>
                    </svg>
                </h5>
                <h2 class="section-title__title">Feel Free to Write us Anytime</h2>
            </div><!-- section-title -->
            <div class="contact-one__form-box  text-center">
                <form action="" class="contact-one__form contact-form-validated"
                      novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contact-one__input-box">
                                <input type="text" placeholder="Your Name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-one__input-box">
                                <input type="email" placeholder="Email Address" name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-one__input-box">
                                <input type="text" placeholder="Phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="contact-one__input-box text-message-box">
                                <textarea name="message" placeholder="Message"></textarea>
                            </div>
                            <div class="contact-one__btn-box">
                                <button type="submit" class="abrish-btn abrish-btn-second"><span
                                        class="arish-btn__curve"></span>Send a Message<i class="icon-arrow"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="result"></div>
            </div>
        </div>
    </section>
    <!-- Contact End -->
    <!--Google Map Start-->
    <section class="google-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d60805.821309409934!2d83.27434427910156!3d17.727487999999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1533129615073"
            width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>
    <!--Google Map End-->
@endsection
