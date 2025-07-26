@extends('main.layouts.main')
@section('title', 'About Us')
@section('content')
    <section class="page-header @@extraClassName" data-jarallax data-speed="0.3" data-imgPosition="50% -100%">
        <div class="page-header__bg jarallax-img"></div>
        <div class="page-header__overlay"></div>
        <div class="container text-center">
            <h2 class="page-header__title">About Us</h2>
            <ul class="page-header__breadcrumb list-unstyled">
                <li><a href="{{ route('main.home') }}">Home</a></li>
                <li><span>@yield('title')</span></li>
            </ul>
        </div>
    </section>
    <section class="about-two about-two--about mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="about-two__thumb wow fadeInLeft animated" data-wow-delay="100ms"
                         style="visibility: visible; animation-delay: 100ms; animation-name: fadeInLeft;">
                        <div class="about-two__thumb__one eduact-tilt"
                             data-tilt-options="{ &quot;glare&quot;: false, &quot;maxGlare&quot;: 0, &quot;maxTilt&quot;: 2, &quot;speed&quot;: 700, &quot;scale&quot;: 1 }"
                             style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);">
                            <img src="{{ asset('uploads/' . $data->image_1) }}" alt="alabrish">
                        </div>
                        <div class="about-two__thumb__two">
                            <img src="{{ asset('uploads/' . $data->image_2) }}" alt="alabrish">
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
                <div class="col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="100ms">
                    <div class="about-two__content">
                        <div class="section-title">
                            <h5 class="section-title__tagline">
                                About Us
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
                            <h2 class="section-title__title">{{ $data->title }}</h2>
                        </div>
                        <p class="about-two__content__text">Your gateway to a comprehensive and enriching educational
                            experience rooted in Islamic teachings. Our academy stands as a beacon of knowledge,
                            offering a diverse range of courses under the esteemed guidance of Madni Scholars from
                            Madina University, Saudi Arabia.</p>
                        <div class="about-two__about-box">
                            <div class="about-two__about-box__top">
                                <h4 class="about-two__about-box__title">Islamic Courses</h4>
                            </div>
                            <p class="about-two__about-box__text">Embark on a journey of spiritual growth with our
                                Quran, Hadith, Tafseer, and other Islamic courses that delve into the profound wisdom of
                                our faith. Our curriculum is meticulously crafted to provide a deep understanding of
                                Islamic principles and values.</p>
                        </div>
                        <div class="about-two__about-box">
                            <div class="about-two__about-box__top">
                                <h4 class="about-two__about-box__title">Technical Courses</h4>
                            </div>
                            <p class="about-two__about-box__text">Explore the world of technology with our cutting-edge
                                technical courses designed to equip you with practical skills and knowledge. From
                                programming to digital design, our technical offerings are tailored to meet the demands
                                of the modern world.</p>
                        </div>
                        <div class="about-two__about-box">
                            <div class="about-two__about-box__top">
                                <h4 class="about-two__about-box__title">Degree Courses</h4>
                            </div>
                            <p class="about-two__about-box__text">Pursue academic excellence with our degree courses
                                that blend traditional knowledge with contemporary education. Our programs are designed
                                to provide a well-rounded education, preparing students for success in their chosen
                                fields.</p>
                        </div>
                    </div><!-- about content end -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-two__about-box">
                        <div class="about-two__about-box__top">
                            <h4 class="about-two__about-box__title">Work from Home Opportunities</h4>
                        </div>
                        <p class="about-two__about-box__text">Experience the flexibility of learning and earning with
                            our work-from-home opportunities. We empower individuals to balance their studies and
                            professional pursuits, fostering a conducive environment for personal and career growth.</p>
                    </div>
                    <div class="about-two__about-box">
                        <div class="about-two__about-box__top">
                            <h4 class="about-two__about-box__title">Skill-Based Courses</h4>
                        </div>
                        <p class="about-two__about-box__text">Acquire valuable skills through our diverse range of
                            skill-based courses. From entrepreneurship to communication skills, we aim to enhance your
                            abilities and empower you to excel in various aspects of life.</p>
                        <p class="about-two__about-box__text">Join us at Al Abrish Islamic Academy, where we merge the
                            richness of Islamic knowledge with modern education under the guidance of esteemed Madni
                            Scholars. Enrich your mind, empower your skills, and embrace the holistic education we offer
                            to shape a brighter future.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About End -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <a href="https://api.whatsapp.com/send?phone=918985006262" class="btn-whmsg" target="_blank"><i
                        class="fab fa-whatsapp"></i> Give Message</a>
            </div>
        </div>
    </div>
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
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 wow fadeInUp animated" data-wow-delay="200ms"
                     style="visibility: visible; animation-delay: 200ms; animation-name: fadeInUp;">
                    <div class="team-one__item">
                        <div class="team-one__image">
                            <img src="{{ asset('main_assets') }}/images/team-1.png" alt="alabrish">
                        </div>
                        <div class="team-one__content">
                            <h3 class="team-one__title">
                                <a href="#">Team Title</a>
                            </h3>
                            <span class="team-one__designation">Teacher</span>
                            <div class="team-one__social">
                                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6  col-sm-6 col-6 wow fadeInUp animated" data-wow-delay="300ms"
                     style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
                    <div class="team-one__item">
                        <div class="team-one__image">
                            <img src="{{ asset('main_assets') }}/images/team-2.png" alt="alabrish">
                        </div>
                        <div class="team-one__content">
                            <h3 class="team-one__title">
                                <a href="#">Team Title</a>
                            </h3>
                            <span class="team-one__designation">Teacher</span>
                            <div class="team-one__social">
                                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 wow fadeInUp animated" data-wow-delay="400ms"
                     style="visibility: visible; animation-delay: 400ms; animation-name: fadeInUp;">
                    <div class="team-one__item">
                        <div class="team-one__image">
                            <img src="{{ asset('main_assets') }}/images/team-3.png" alt="alabrish">
                        </div>
                        <div class="team-one__content">
                            <h3 class="team-one__title">
                                <a href="#">Team Title</a>
                            </h3>
                            <span class="team-one__designation">Teacher</span>
                            <div class="team-one__social">
                                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 wow fadeInUp animated" data-wow-delay="400ms"
                     style="visibility: visible; animation-delay: 400ms; animation-name: fadeInUp;">
                    <div class="team-one__item">
                        <div class="team-one__image">
                            <img src="{{ asset('main_assets') }}/images/team-4.png" alt="alabrish">
                        </div>
                        <div class="team-one__content">
                            <h3 class="team-one__title">
                                <a href="#">Team Title</a>
                            </h3>
                            <span class="team-one__designation">Teacher</span>
                            <div class="team-one__social">
                                <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                <a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center pt-3">
                <div class="col-lg-3 text-center"><a href="our-team.php" class="abrish-btn shadow"><span
                            class="abrish-btn__curve"></span>View All<i class="icon-arrow"></i></a></div>
            </div>
        </div>
    </section>
@endsection
