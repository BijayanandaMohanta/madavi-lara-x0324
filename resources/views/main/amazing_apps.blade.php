@extends('main.layouts.main')
@section('title', 'Amazing apps')
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
    <section class="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="100ms">
                    <div class="course-two__item">
                        <div class="course-two__thumb">
                            <a href="#"> <img src="{{ asset('main_assets') }}/images/amazon-logo.jpg" alt="alabrish"></a>
                        </div>
                        <div class="course-two__content text-center">
                            <h3 class="course-two__title mb-1">
                                <a href="#">Amazon</a>
                            </h3>
                            <div class="course-two__bottom">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature  is not simply text.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="100ms">
                    <div class="course-two__item">
                        <div class="course-two__thumb">
                            <a href="#"> <img src="{{ asset('main_assets') }}/images/flipkart-logo.jpg" alt="alabrish"></a>
                        </div>
                        <div class="course-two__content text-center">
                            <h3 class="course-two__title mb-1">
                                <a href="#">Flipkart</a>
                            </h3>
                            <div class="course-two__bottom">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature  is not simply text.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="100ms">
                    <div class="course-two__item">
                        <div class="course-two__thumb">
                            <a href="#"> <img src="{{ asset('main_assets') }}/images/myntra-logo.jpg" alt="alabrish"></a>
                        </div>
                        <div class="course-two__content text-center">
                            <h3 class="course-two__title mb-1">
                                <a href="#">Myntra</a>
                            </h3>
                            <div class="course-two__bottom">
                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature  is not simply text.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
