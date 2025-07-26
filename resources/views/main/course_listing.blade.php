@extends('main.layouts.main')
@section('title', 'Courses Listing')
@section('content')
    <section class="page-header @@extraClassName" data-jarallax data-speed="0.3" data-imgPosition="50% -100%">
        <div class="page-header__bg jarallax-img"></div>
        <div class="page-header__overlay"></div>
        <div class="container text-center">
            <h2 class="page-header__title">@yield('title')</h2>
            <ul class="page-header__breadcrumb list-unstyled">
                <li><a href="{{ route('main.home') }}">Home</a></li>
                <li><a href="{{ route('main.courses') }}">Courses</a></li>
                <li><span>@yield('title')</span></li>
            </ul>
        </div>
    </section>
    <section class="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5 wow fadeInLeft" data-wow-delay="200ms">
                    <div class="product__sidebar product__sidebar--left">
                        <div class="product__sidebar__single product__categories">
                            <h3 class="product__sidebar__title">Course Categories</h3>
                            <ul class="list-unstyled">
                                <li><a href="">Arabic</a></li>
                                <li><a href="">Tejweed</a></li>
                                <li><a href="">Quran</a></li>
                                <li><a href="">IELTS</a></li>
                                <li><a href="">Computers</a></li>
                                <li><a href="">Seerah</a></li>
                                <li><a href="">Marketing</a></li>
                                <li><a href="">Designin</a></li>
                                <li><a href="">Academics</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="row">
                        <?php for($i=1;$i<=6;$i++) {?>
                        <div class="col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                            <div class="course-two__item">
                                <div class="course-two__thumb">
                                    <a href="{{ route('main.course_view', ['slug' => 'test']) }}"> <img src="{{ asset('main_assets') }}/images/arabic-<?php echo $i;?>.jpg" alt="alabrish"></a>
                                </div>
                                <div class="course-two__content">
                                    <div class="course-two__time"><i class="fal fa-video"></i> Videos</div>
                                    <div class="course-two__time"><i class="fal fa-file"></i> Files</div>
                                    <h3 class="course-two__title">
                                        <a href="{{ route('main.course_view', ['slug' => 'test']) }}">Arabic Speaking & Reading Course</a>
                                    </h3>
                                    <div class="course-two__bottom">
                                        <div class="course-two__meta">
                                            <h4 class="course-two__meta__price"><i class="fal fa-rupee-sign"></i> 473.00</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="blog-page__pagination clearfix">
                                <li class="next"><a href="#"><span class="icon-caret-left"></span></a></li>
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li class="next"><a href="#"><span class="icon-caret-right"></span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
