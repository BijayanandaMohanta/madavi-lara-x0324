@extends('main.layouts.main')
@section('title', 'Blog View')
@section('content')
    <section class="page-header @@extraClassName" data-jarallax data-speed="0.3" data-imgPosition="50% -100%">
        <div class="page-header__bg jarallax-img"></div>
        <div class="page-header__overlay"></div>
        <div class="container text-center">
            <h2 class="page-header__title">@yield('title')</h2>
            <ul class="page-header__breadcrumb list-unstyled">
                <li><a href="{{ route('main.home') }}">Home</a></li>
                <li><a href="{{ route('main.blog') }}">Blog</a></li>
                <li><span>@yield('title')</span></li>
            </ul>
        </div>
    </section>
    <!-- Blog Start -->
    <section class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-details__content">
                        <div class="blog-details__img">
                            <img src="{{ asset('main_assets') }}/images/blog-1.jpg" alt="">
                        </div>
                        <div class="blog-details__meta">
                            <div class="blog-details__meta__cats">
                                <a href="#">Development</a>
                            </div>
                            <div class="blog-details__meta__date"><i class="icon-clock"></i>26 Mar, 2023</div>
                        </div>
                        <h3 class="blog-details__title">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore max</h3>
                        <div class="py-2">
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_24 a2a_default_style">
                                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                <a class="a2a_button_whatsapp"></a>
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_email"></a>
                                <a class="a2a_button_pinterest"></a>
                            </div>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                            <!-- AddToAny END -->
                        </div>
                        <p class="blog-details__text">
                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form,
                            by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of
                            Lorem Ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum
                            sollicitudin varius mauris non dignissim. Sed quis iaculis est. Nulla quam neque, interdum vitae fermentum lacinia,
                            interdum eu magna. Mauris non posuere tellus. Donec quis euismod tellus. Nam vel lacus eu nisl bibendum accumsan
                            vitae vitae nibh. Nam nec eros id magna hendrerit sagittis. Nullam sed mi non odio feugiat volutpat sit amet nec elit.
                            Maecenas id hendrerit ipsum. Sed eget auctor metus, ac dapibus dolor
                        </p>
                        <p class="blog-details__text">
                            Nam vel lacus eu nisl bibendum accumsan vitae vitae nibh. Nam nec eros id magna hendrerit sagittis. Nullam sed mi non
                            odio feugiat volutpat sit amet nec elit. Maecenas id hendrerit ipsum. Sed eget auctor metus, ac dapibus dolor.
                            Mauris gravida lacus metus, ac sagittis tortor hendrerit sit amet. Aenean dictum eget nulla in pharetra.
                            Vestibulum vulputate vehicula mattis. Vivamus dictum nec dui porta rutrum. Nam erat felis, mattis ac massa
                        </p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 wow fadeInRight" data-wow-delay="300ms">
                    <div class="sidebar">
                        <div class="sidebar__single sidebar__post">
                            <h3 class="sidebar__title">Latest posts</h3>
                            <ul class="sidebar__post__list list-unstyled">
                                <li>
                                    <div class="sidebar__post__image">
                                        <img src="{{ asset('main_assets') }}/images/blog-1.jpg" alt="">
                                    </div>
                                    <div class="sidebar__post__content">
                                        <span class="sidebar__post__content__meta"><i class="icon-clock"></i>26 Oct, 2023</span>
                                        <h3 class="sidebar__post__content__title"><a href="blog-view.php">Lorem ipsum dolor sit amet, consectetur.</a></h3>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar__post__image">
                                        <img src="{{ asset('main_assets') }}/images/blog-2.jpg" alt="">
                                    </div>
                                    <div class="sidebar__post__content">
                                        <span class="sidebar__post__content__meta"><i class="icon-clock"></i>26 Oct, 2023</span>
                                        <h3 class="sidebar__post__content__title"><a href="blog-view.php">Dignissimos a rem saepe, numquam dolores soluta similique.</a></h3>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar__post__image">
                                        <img src="{{ asset('main_assets') }}/images/blog-3.jpg" alt="">
                                    </div>
                                    <div class="sidebar__post__content">
                                        <span class="sidebar__post__content__meta"><i class="icon-clock"></i>26 Nov, 2023</span>
                                        <h3 class="sidebar__post__content__title"><a href="blog-view.php">Basic Rules of Running Web Agency business Solution</a></h3>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- latest-post-widget -->
                        <div class="sidebar__single sidebar__category">
                            <h3 class="sidebar__title">Categories</h3>
                            <ul class="sidebar__category-list list-unstyled">
                                <li><a href="blog.php">Lorem ipsum, dolor sit amet placeat</a></li>
                                <li><a href="blog.php">Repellat ipsa omnis sed nulla!</a></li>
                                <li><a href="blog.php">Consectetur adipisicing elit.</a></li>
                                <li><a href="blog.php">Eaque tenetur maiores iusto </a></li>
                                <li><a href="blog.php">Delectus architecto earu</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog End -->
@endsection
