@extends('main.layouts.main')
@section('title', 'Home')
@section('content')
    <section class="main-slider">
        <div class="main-slider__one abrish-owl__carousel owl-carousel"
             data-owl-options='{"loop": true, "animateIn": "fadeIn", "items": 1,"smartSpeed": 1000,"autoplay": true,"autoplayTimeout": 7000, "autoplayHoverPause": false, "nav": false, "dots": true, "margin": 0 }'>
            @foreach($data['banners'] as $value)
                <div class="item">
                    <div class="main-slider__item">
                        <div class="main-slider__bg"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="main-slider__content">
                                        <h2 class="main-slider__title">{{ $value->title }}</h2>
                                        <p class="main-slider__text">{{ $value->text }}</p>
                                        <div class="main-slider__btn">
                                            <a href="{{ route('main.courses') }}"
                                               class="abrish-btn abrish-btn-second"><span
                                                    class="abrish-btn__curve"></span>Find the Courses<i
                                                    class="icon-arrow"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4 col-sm-5">
                                    <div class="main-slider__layer">
                                        <div class="main-slider__layer-thumb abrish-tilt"
                                             data-tilt-options='{ "glare": false, "maxGlare": 0, "maxTilt": 2, "speed": 700, "scale": 1 }'>
                                            <img src="{{ asset('uploads/' . $value->image) }}"
                                                 alt="{{ $value->title }}">
                                        </div>
                                    </div>
                                    <div class="main-slider__shape-three">
                                        <svg viewBox="0 0 152 152" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="76" cy="76" r="63.7419" stroke="#F57005" stroke-width="24"/>
                                        </svg>
                                    </div>
                                    <div class="main-slider__shape-four">
                                        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="16" cy="16" r="15" stroke="#F1F2FD" stroke-width="2"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="about-two">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="about-two__thumb wow fadeInLeft animated" data-wow-delay="100ms"
                         style="visibility: visible; animation-delay: 100ms; animation-name: fadeInLeft;">
                        <div class="about-two__thumb__one eduact-tilt"
                             data-tilt-options="{ &quot;glare&quot;: false, &quot;maxGlare&quot;: 0, &quot;maxTilt&quot;: 2, &quot;speed&quot;: 700, &quot;scale&quot;: 1 }"
                             style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);">
                            <img src="{{ asset('uploads/' . $data['about_us']->image_1) }}" alt="alabrish">
                        </div>
                        <div class="about-two__thumb__two">
                            <img src="{{ asset('uploads/' . $data['about_us']->image_2) }}" alt="alabrish">
                            <div class="about-two__thumb__two-icon"><span class="icon-business"></span></div>
                        </div>
                        <div class="about-two__thumb__shape1 wow zoomIn animated" data-wow-delay="300ms"
                             style="visibility: visible; animation-delay: 300ms; animation-name: zoomIn;">
                            <img src="{{ asset('main_assets/images/shapes/about-2-shape-1.png') }}" alt="alabrish">
                        </div>
                        <div class="about-two__thumb__shape3 wow zoomIn animated" data-wow-delay="400ms"
                             style="visibility: visible; animation-delay: 400ms; animation-name: zoomIn;">
                            <img src="{{ asset('main_assets/images/shapes/about-2-shape-3.png') }}" alt="alabrish">
                        </div>
                        <div class="about-two__thumb__shape4 wow zoomIn animated" data-wow-delay="400ms"
                             style="visibility: visible; animation-delay: 400ms; animation-name: zoomIn;">
                            <img src="{{ asset('main_assets/images/shapes/about-2-shape-4.png') }}" alt="alabrish">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6  col-lg-6 col-md-6 wow fadeInRight animated" data-wow-delay="100ms"
                     style="visibility: visible; animation-delay: 100ms; animation-name: fadeInRight;">
                    <div class="about-two__content">
                        <div class="section-title">
                            <h5 class="section-title__tagline">
                                About Us
                                <svg class="arrow-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55 13">
                                    <g clip-path="url(#clip0_324_36194)">
                                        <path
                                            d="M10.5406 6.49995L0.700562 12.1799V8.56995L4.29056 6.49995L0.700562 4.42995V0.819946L10.5406 6.49995Z"></path>
                                        <path
                                            d="M25.1706 6.49995L15.3306 12.1799V8.56995L18.9206 6.49995L15.3306 4.42995V0.819946L25.1706 6.49995Z"></path>
                                        <path
                                            d="M39.7906 6.49995L29.9506 12.1799V8.56995L33.5406 6.49995L29.9506 4.42995V0.819946L39.7906 6.49995Z"></path>
                                        <path
                                            d="M54.4206 6.49995L44.5806 12.1799V8.56995L48.1706 6.49995L44.5806 4.42995V0.819946L54.4206 6.49995Z"></path>
                                    </g>
                                </svg>
                            </h5>
                            <h2 class="section-title__title">{{ $data['about_us']->title }}</h2>
                        </div>
                        <p class="about-two__content__text">
                            {!! \Illuminate\Support\Str::limit($data['about_us']->about_us_description ?? '', 270, '') !!}
                        </p>
                        <div class="about-two__box d-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 295 125">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M86 0.0805664H58C25.9675 0.0805664 0 26.048 0 58.0806V79.5806C0 104.157 19.9233 124.081 44.5 124.081H46.5C69.9721 124.081 89 105.053 89 81.5806C89 58.1085 108.028 39.0806 131.5 39.0806H268C282.912 39.0806 295 26.9923 295 12.0806C295 5.45315 289.627 0.0805664 283 0.0805664H89H86Z"></path>
                            </svg>
                            <div class="about-two__box__icon"><span class="icon-Presentation"></span></div>
                            <h4 class="about-two__box__title">Flexible Classes</h4>
                            <p class="about-two__box__text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero quisquam dolores
                                architecto dolore deleniti sed
                            </p>
                        </div>
                        <ul class="about-two__lists clearfix">
                            @foreach($data['about_us_key_points'] as $value)
                                <li><span class="icon-check"></span>{{ $value }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('main.about_us') }}" class="abrish-btn"><span
                                class="abrish-btn__curve"></span>Read More<i class="icon-arrow"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Start -->
    <section class="service-three" style="background: linear-gradient(to right, #f8f8f8 20%, #fff 90%);">
        <div class="container">
            <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-2 justify-content-center">
                <div class="col wow fadeInUp" data-wow-delay="200ms">
                    <a href="#">
                        <div class="usercategorybox">
                            <div class="icon shadow-sm"><img src="{{ asset('main_assets') }}/images/caticon-1.png"
                                                             alt=""></div>
                            <h4>Login As A Teacher Teacher's Profile</h4>
                        </div>
                    </a>
                </div>
                <div class="col wow fadeInUp" data-wow-delay="200ms">
                    <a href="#">
                        <div class="usercategorybox">
                            <div class="icon shadow-sm"><img src="{{ asset('main_assets') }}/images/caticon-2.png"
                                                             alt=""></div>
                            <h4>Charity</h4>
                        </div>
                    </a>
                </div>
                <div class="col wow fadeInUp" data-wow-delay="200ms">
                    <a href="{{ route('main.courses') }}">
                        <div class="usercategorybox">
                            <div class="icon shadow-sm"><img src="{{ asset('main_assets') }}/images/caticon-3.png"
                                                             alt=""></div>
                            <h4>Module Courses</h4>
                        </div>
                    </a>
                </div>
                <div class="col wow fadeInUp" data-wow-delay="200ms">
                    <a href="daily-islamic-reminder.php">
                        <div class="usercategorybox">
                            <div class="icon shadow-sm"><img src="{{ asset('main_assets') }}/images/caticon-4.png"
                                                             alt=""></div>
                            <h4>Daily Islamic Reminders</h4>
                        </div>
                    </a>
                </div>
                <div class="col wow fadeInUp" data-wow-delay="200ms">
                    <a href="daily-activities.php">
                        <div class="usercategorybox">
                            <div class="icon shadow-sm"><img src="{{ asset('main_assets') }}/images/caticon-5.png"
                                                             alt=""></div>
                            <h4>Daily Activities</h4>
                        </div>
                    </a>
                </div>
                <div class="col wow fadeInUp" data-wow-delay="200ms">
                    <a href="{{ route('main.library_wishlist_books') }}">
                        <div class="usercategorybox">
                            <div class="icon shadow-sm"><img src="{{ asset('main_assets') }}/images/caticon-6.png"
                                                             alt=""></div>
                            <h4>Library</h4>
                        </div>
                    </a>
                </div>
                <div class="col wow fadeInUp" data-wow-delay="200ms">
                    <a href="{{ route('main.shop') }}">
                        <div class="usercategorybox">
                            <div class="icon shadow-sm"><img src="{{ asset('main_assets') }}/images/caticon-7.png"
                                                             alt=""></div>
                            <h4>Shop</h4>
                        </div>
                    </a>
                </div>
                <div class="col wow fadeInUp" data-wow-delay="200ms">
                    <a href="{{ route('main.amazing_apps') }}">
                        <div class="usercategorybox">
                            <div class="icon shadow-sm"><img src="{{ asset('main_assets') }}/images/caticon-8.png"
                                                             alt=""></div>
                            <h4>Amazing Apps</h4>
                        </div>
                    </a>
                </div>
                <div class="col wow fadeInUp" data-wow-delay="200ms">
                    <a href="{{ route('main.about_us') }}">
                        <div class="usercategorybox">
                            <div class="icon shadow-sm"><img src="{{ asset('main_assets') }}/images/caticon-9.png"
                                                             alt=""></div>
                            <h4>About Us</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Service End -->

    <section class="course-three"
             style="background-image: url({{ asset('main_assets') }}/images/shapes/course-bg-3.png);">

        <div class="container">
            <div class="section-title text-center">
                <h5 class="section-title__tagline">
                    Module Courses
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 133 13" fill="none">
                        <path
                            d="M9.76794 0.395L0.391789 9.72833C-0.130596 10.2483 -0.130596 11.095 0.391789 11.615C0.914174 12.135 1.76472 12.135 2.28711 11.615L11.6633 2.28167C12.1856 1.76167 12.1856 0.915 11.6633 0.395C11.1342 -0.131667 10.2903 -0.131667 9.76794 0.395Z"
                            fill="#F1F2FD"></path>
                        <path
                            d="M23.1625 0.395L13.7863 9.72833C13.2639 10.2483 13.2639 11.095 13.7863 11.615C14.3087 12.135 15.1593 12.135 15.6816 11.615L25.0578 2.28167C25.5802 1.76167 25.5802 0.915 25.0578 0.395C24.5287 -0.131667 23.6849 -0.131667 23.1625 0.395Z"
                            fill="#F1F2FD"></path>
                        <path
                            d="M36.5569 0.395L27.1807 9.72833C26.6583 10.2483 26.6583 11.095 27.1807 11.615C27.7031 12.135 28.5537 12.135 29.076 11.615L38.4522 2.28167C38.9746 1.76167 38.9746 0.915 38.4522 0.395C37.9231 -0.131667 37.0793 -0.131667 36.5569 0.395Z"
                            fill="#F1F2FD"></path>
                        <path
                            d="M49.9514 0.395L40.5753 9.72833C40.0529 10.2483 40.0529 11.095 40.5753 11.615C41.0976 12.135 41.9482 12.135 42.4706 11.615L51.8467 2.28167C52.3691 1.76167 52.3691 0.915 51.8467 0.395C51.3176 -0.131667 50.4738 -0.131667 49.9514 0.395Z"
                            fill="#F1F2FD"></path>
                        <path
                            d="M63.3459 0.395L53.9698 9.72833C53.4474 10.2483 53.4474 11.095 53.9698 11.615C54.4922 12.135 55.3427 12.135 55.8651 11.615L65.2413 2.28167C65.7636 1.76167 65.7636 0.915 65.2413 0.395C64.7122 -0.131667 63.8683 -0.131667 63.3459 0.395Z"
                            fill="#F1F2FD"></path>
                        <path
                            d="M76.7405 0.395L67.3643 9.72833C66.8419 10.2483 66.8419 11.095 67.3643 11.615C67.8867 12.135 68.7373 12.135 69.2596 11.615L78.6358 2.28167C79.1582 1.76167 79.1582 0.915 78.6358 0.395C78.1067 -0.131667 77.2629 -0.131667 76.7405 0.395Z"
                            fill="#F1F2FD"></path>
                        <path
                            d="M90.1349 0.395L80.7587 9.72833C80.2363 10.2483 80.2363 11.095 80.7587 11.615C81.2811 12.135 82.1317 12.135 82.6541 11.615L92.0302 2.28167C92.5526 1.76167 92.5526 0.915 92.0302 0.395C91.5011 -0.131667 90.6573 -0.131667 90.1349 0.395Z"
                            fill="#F1F2FD"></path>
                        <path
                            d="M103.529 0.395L94.1533 9.72833C93.6309 10.2483 93.6309 11.095 94.1533 11.615C94.6756 12.135 95.5262 12.135 96.0486 11.615L105.425 2.28167C105.947 1.76167 105.947 0.915 105.425 0.395C104.896 -0.131667 104.052 -0.131667 103.529 0.395Z"
                            fill="#F1F2FD"></path>
                        <path
                            d="M116.924 0.395L107.548 9.72833C107.025 10.2483 107.025 11.095 107.548 11.615C108.07 12.135 108.921 12.135 109.443 11.615L118.819 2.28167C119.342 1.76167 119.342 0.915 118.819 0.395C118.29 -0.131667 117.446 -0.131667 116.924 0.395Z"
                            fill="#F1F2FD"></path>
                        <path
                            d="M130.318 0.395L120.942 9.72833C120.42 10.2483 120.42 11.095 120.942 11.615C121.465 12.135 122.315 12.135 122.838 11.615L132.214 2.28167C132.736 1.76167 132.736 0.915 132.214 0.395C131.685 -0.131667 130.841 -0.131667 130.318 0.395Z"
                            fill="#F1F2FD"></path>
                    </svg>
                </h5>
                <h2 class="section-title__title">Ready to find a Course</h2>
            </div><!-- section-title -->
            <div class="category-one__slider abrish-owl__carousel owl-with-shadow owl-theme owl-carousel"
                 data-owl-options='{
                    "items": 3,
                    "margin": 30,
                    "smartSpeed": 700,
                    "loop":false,
                    "autoplay": true,
                    "nav":false,
                    "dots":true,
                    "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow\"></span>"],
                    "responsive":{
                        "0":{
                            "items":1,
                            "nav":true,
                            "dots":false,
                            "margin": 1
                        },
                        "768":{
                            "nav":true,
                            "dots":false,
                            "items": 2
                        },
                        "992":{
                            "items": 3
                        },
                        "1200":{
                            "items": 3
                        },
                        "1400":{
                            "items": 3,
                            "margin": 36
                        }
                    }
                    }'>
                <div class="item">
                    <div class="course-one__item">
                        <div class="course-one__thumb">
                            <img src="{{ asset('main_assets') }}/images/course-1.png" alt="abrish">
                        </div>
                        <div class="course-one__content">
                            <div class="course-one__time">20 Hours</div>
                            <div class="course-one__ratings">
                                <div class="course-one__ratings__reviews">Duration: 45 Days</div>
                            </div>
                            <h3 class="course-one__title">
                                <a href="{{ route('main.course_view', ['slug' => 'test']) }}">Arabic Speaking & Reading
                                    Course</a>
                            </h3>
                            <div class="course-one__bottom">
                                <div class="course-one__author">
                                    <img src="{{ asset('main_assets') }}/images/author-1.png" alt="abrish"
                                         style="width: 40px;">
                                    <h5 class="course-one__author__name">Abhijit Paul</h5>
                                    <p class="course-one__author__designation">Teacher</p>
                                </div>
                                <div class="course-one__meta">
                                    <h4 class="course-one__meta__price"><i class="fal fa-rupee-sign"></i> 999.00</h4>
                                    <p class="course-one__meta__class">15 Lessons</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="course-one__item">
                        <div class="course-one__thumb">
                            <img src="{{ asset('main_assets') }}/images/course-2.png" alt="abrish">
                        </div>
                        <div class="course-one__content">
                            <div class="course-one__time">20 Hours</div>
                            <div class="course-one__ratings">
                                <div class="course-one__ratings__reviews">Duration: 45 Days</div>
                            </div>
                            <h3 class="course-one__title">
                                <a href="{{ route('main.course_view', ['slug' => 'test']) }}">Short Islamic Course For
                                    Sisters</a>
                            </h3>
                            <div class="course-one__bottom">
                                <div class="course-one__author">
                                    <img src="{{ asset('main_assets') }}/images/author-1.png" alt="abrish"
                                         style="width: 40px;">
                                    <h5 class="course-one__author__name">Abhijit Paul</h5>
                                    <p class="course-one__author__designation">Teacher</p>
                                </div>
                                <div class="course-one__meta">
                                    <h4 class="course-one__meta__price"><i class="fal fa-rupee-sign"></i> 999.00</h4>
                                    <p class="course-one__meta__class">15 Lessons</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="course-one__item">
                        <div class="course-one__thumb">
                            <img src="{{ asset('main_assets') }}/images/course-3.png" alt="abrish">
                        </div>
                        <div class="course-one__content">
                            <div class="course-one__time">20 Hours</div>
                            <div class="course-one__ratings">
                                <div class="course-one__ratings__reviews">Duration: 45 Days</div>
                            </div>
                            <h3 class="course-one__title">
                                <a href="{{ route('main.course_view', ['slug' => 'test']) }}">Online Islamic Madrasa For
                                    Kids According To The Way </a>
                            </h3>
                            <div class="course-one__bottom">
                                <div class="course-one__author">
                                    <img src="{{ asset('main_assets') }}/images/author-1.png" alt="abrish"
                                         style="width: 40px;">
                                    <h5 class="course-one__author__name">Abhijit Paul</h5>
                                    <p class="course-one__author__designation">Teacher</p>
                                </div>
                                <div class="course-one__meta">
                                    <h4 class="course-one__meta__price"><i class="fal fa-rupee-sign"></i> 999.00</h4>
                                    <p class="course-one__meta__class">15 Lessons</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="course-one__item">
                        <div class="course-one__thumb">
                            <img src="{{ asset('main_assets') }}/images/course-1.png" alt="abrish">
                        </div>
                        <div class="course-one__content">
                            <div class="course-one__time">20 Hours</div>
                            <div class="course-one__ratings">
                                <div class="course-one__ratings__reviews">Duration: 45 Days</div>
                            </div>
                            <h3 class="course-one__title">
                                <a href="{{ route('main.course_view', ['slug' => 'test']) }}">Arabic Speaking & Reading
                                    Course</a>
                            </h3>
                            <div class="course-one__bottom">
                                <div class="course-one__author">
                                    <img src="{{ asset('main_assets') }}/images/author-1.png" alt="abrish"
                                         style="width: 40px;">
                                    <h5 class="course-one__author__name">Abhijit Paul</h5>
                                    <p class="course-one__author__designation">Teacher</p>
                                </div>
                                <div class="course-one__meta">
                                    <h4 class="course-one__meta__price"><i class="fal fa-rupee-sign"></i> 999.00</h4>
                                    <p class="course-one__meta__class">15 Lessons</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center pt-5">
                <div class="col-lg-3 text-center"><a href="{{ route('main.courses') }}" class="abrish-btn shadow"><span
                            class="abrish-btn__curve"></span>View All Courses<i class="icon-arrow"></i></a></div>
            </div>
        </div>
    </section>
    <!-- Team Start -->
    <section class="team-one" style="background-image: url({{ asset('main_assets') }}/images/shapes/team-bg-1.png);">
        <div class="container">
            <div class="section-title text-center wow fadeInUp animated" data-wow-delay="100ms"
                 style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                <h5 class="section-title__tagline">
                    Team Member
                    <svg viewBox="0 0 170 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.4101 0.395L1.034 9.72833C0.511616 10.2483 0.511616 11.095 1.034 11.615C1.55639 12.135 2.40694 12.135 2.92932 11.615L12.3055 2.28167C12.8279 1.76167 12.8279 0.915 12.3055 0.395C11.7764 -0.131667 10.9325 -0.131667 10.4101 0.395Z"
                            fill="white"></path>
                        <path
                            d="M23.4652 0.395L14.0891 9.72833C13.5667 10.2483 13.5667 11.095 14.0891 11.615C14.6114 12.135 15.462 12.135 15.9844 11.615L25.3605 2.28167C25.8829 1.76167 25.8829 0.915 25.3605 0.395C24.8314 -0.131667 23.9876 -0.131667 23.4652 0.395Z"
                            fill="white"></path>
                        <path
                            d="M36.5203 0.395L27.1441 9.72833C26.6217 10.2483 26.6217 11.095 27.1441 11.615C27.6665 12.135 28.517 12.135 29.0394 11.615L38.4156 2.28167C38.938 1.76167 38.938 0.915 38.4156 0.395C37.8865 -0.131667 37.0426 -0.131667 36.5203 0.395Z"
                            fill="white"></path>
                        <path
                            d="M49.5753 0.395L40.1992 9.72833C39.6768 10.2483 39.6768 11.095 40.1992 11.615C40.7215 12.135 41.5721 12.135 42.0945 11.615L51.4706 2.28167C51.993 1.76167 51.993 0.915 51.4706 0.395C50.9415 -0.131667 50.0977 -0.131667 49.5753 0.395Z"
                            fill="white"></path>
                        <path
                            d="M62.6304 0.395L53.2542 9.72833C52.7318 10.2483 52.7318 11.095 53.2542 11.615C53.7766 12.135 54.6272 12.135 55.1495 11.615L64.5257 2.28167C65.0481 1.76167 65.0481 0.915 64.5257 0.395C63.9966 -0.131667 63.1527 -0.131667 62.6304 0.395Z"
                            fill="white"></path>
                        <path
                            d="M75.6854 0.395L66.3093 9.72833C65.7869 10.2483 65.7869 11.095 66.3093 11.615C66.8317 12.135 67.6822 12.135 68.2046 11.615L77.5807 2.28167C78.1031 1.76167 78.1031 0.915 77.5807 0.395C77.0517 -0.131667 76.2078 -0.131667 75.6854 0.395Z"
                            fill="white"></path>
                        <path
                            d="M88.7405 0.395L79.3643 9.72833C78.8419 10.2483 78.8419 11.095 79.3643 11.615C79.8867 12.135 80.7373 12.135 81.2596 11.615L90.6358 2.28167C91.1582 1.76167 91.1582 0.915 90.6358 0.395C90.1067 -0.131667 89.2629 -0.131667 88.7405 0.395Z"
                            fill="white"></path>
                        <path
                            d="M101.796 0.395L92.4194 9.72833C91.897 10.2483 91.897 11.095 92.4194 11.615C92.9418 12.135 93.7923 12.135 94.3147 11.615L103.691 2.28167C104.213 1.76167 104.213 0.915 103.691 0.395C103.162 -0.131667 102.318 -0.131667 101.796 0.395Z"
                            fill="white"></path>
                        <path
                            d="M114.85 0.395L105.474 9.72833C104.952 10.2483 104.952 11.095 105.474 11.615C105.997 12.135 106.847 12.135 107.37 11.615L116.746 2.28167C117.268 1.76167 117.268 0.915 116.746 0.395C116.217 -0.131667 115.373 -0.131667 114.85 0.395Z"
                            fill="white"></path>
                        <path
                            d="M127.906 0.395L118.529 9.72833C118.007 10.2483 118.007 11.095 118.529 11.615C119.052 12.135 119.902 12.135 120.425 11.615L129.801 2.28167C130.323 1.76167 130.323 0.915 129.801 0.395C129.272 -0.131667 128.428 -0.131667 127.906 0.395Z"
                            fill="white"></path>
                        <path
                            d="M140.961 0.395L131.584 9.72833C131.062 10.2483 131.062 11.095 131.584 11.615C132.107 12.135 132.957 12.135 133.48 11.615L142.856 2.28167C143.378 1.76167 143.378 0.915 142.856 0.395C142.327 -0.131667 141.483 -0.131667 140.961 0.395Z"
                            fill="white"></path>
                        <path
                            d="M154.016 0.395L144.639 9.72833C144.117 10.2483 144.117 11.095 144.639 11.615C145.162 12.135 146.012 12.135 146.535 11.615L155.911 2.28167C156.433 1.76167 156.433 0.915 155.911 0.395C155.382 -0.131667 154.538 -0.131667 154.016 0.395Z"
                            fill="white"></path>
                        <path
                            d="M167.071 0.395L157.695 9.72833C157.172 10.2483 157.172 11.095 157.695 11.615C158.217 12.135 159.067 12.135 159.59 11.615L168.966 2.28167C169.488 1.76167 169.488 0.915 168.966 0.395C168.437 -0.131667 167.593 -0.131667 167.071 0.395Z"
                            fill="white"></path>
                    </svg>
                </h5>
                <h2 class="section-title__title">Meet Our Professional Team Members</h2>
            </div><!-- section-title -->
            <div class="row">
                @foreach($data['our_team'] as $value)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 wow fadeInUp animated" data-wow-delay="200ms"
                         style="visibility: visible; animation-delay: 200ms; animation-name: fadeInUp;">
                        <div class="team-one__item">
                            <div class="team-one__image">
                                <img src="{{ asset('uploads/' . $value->image) }}" alt="{{ $value->name }}">
                            </div>
                            <div class="team-one__content">
                                <h3 class="team-one__title">
                                    <a href="javascript:void(0)">{{ $value->name }}</a>
                                </h3>
                                <span class="team-one__designation">{{ $value->designation }}</span>
                                <div class="team-one__social">
                                    @if($value->facebook != '')
                                        <a href="{{ $value->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if($value->linkedin != '')
                                        <a href="{{ $value->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                                    @endif
                                    @if($value->youtube != '')
                                        <a href="{{ $value->youtube }}"><i class="fab fa-youtube"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row justify-content-center pt-3">
                <div class="col-lg-3 text-center"><a href="{{ route('main.our_team') }}" class="abrish-btn shadow"><span class="abrish-btn__curve"></span>View All<i class="icon-arrow"></i></a></div>
            </div>
        </div>
    </section>
@endsection

