@extends('main.layouts.main')
@section('title', 'Blog')
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
    <!-- Blog Start -->
    <section class="blog-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="row">
                        @foreach($data as $value)
                            <div class="col-xl-12 col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="100ms">
                                <div class="blog-two__item blog-two__item--list">
                                    <div class="blog-two__image">
                                        <img src="{{ asset('uploads/'. $value->image) }}" alt="{{ $value->title }}">
                                        <a href="{{ route('main.blog_view', ['slug' => 'test']) }}"></a>
                                    </div>
                                    <div class="blog-two__content">
                                        <div class="blog-two__top-meta">
                                            <div class="blog-two__cats"><a href="#">Development</a></div>
                                            <div class="blog-two__date"><i class="icon-clock"></i>10 Oct, 2023</div>
                                        </div>
                                        <h3 class="blog-two__title">
                                            <a href="{{ route('main.blog_view', ['slug' => 'test']) }}">
                                                {{ $value->title }}
                                            </a>
                                        </h3>
                                        <p class="blog-two__text">
                                            {{ \Illuminate\Support\Str::of($value->description ?? '')->limit(150) }}

{{--                                            {!! \Illuminate\Support\Str::limit($value->description ?? '', 150) !!}--}}
                                        </p>
                                        <div class="blog-two__meta">
                                            <div class="blog-two__meta__author">
                                                <i class="fal fa-user"></i> Admin
                                            </div>
                                            <a class="blog-two__rm"
                                               href="{{ route('main.blog_view', ['slug' => 'test']) }}"><span
                                                    class="icon-arrow"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="blog-page__pagination text-left clearfix">
                                <li><a href="blog-list-left.html" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li class="next"><a href="#"><span class="icon-caret-right"></span></a></li>
                            </ul>
                        </div>
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
                                        <h3 class="sidebar__post__content__title"><a
                                                href="{{ route('main.blog_view', ['slug' => 'test']) }}">Lorem ipsum
                                                dolor sit amet, consectetur.</a></h3>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar__post__image">
                                        <img src="{{ asset('main_assets') }}/images/blog-2.jpg" alt="">
                                    </div>
                                    <div class="sidebar__post__content">
                                        <span class="sidebar__post__content__meta"><i class="icon-clock"></i>26 Oct, 2023</span>
                                        <h3 class="sidebar__post__content__title"><a
                                                href="{{ route('main.blog_view', ['slug' => 'test']) }}">Dignissimos a
                                                rem saepe, numquam dolores soluta similique.</a></h3>
                                    </div>
                                </li>
                                <li>
                                    <div class="sidebar__post__image">
                                        <img src="{{ asset('main_assets') }}/images/blog-3.jpg" alt="">
                                    </div>
                                    <div class="sidebar__post__content">
                                        <span class="sidebar__post__content__meta"><i class="icon-clock"></i>26 Nov, 2023</span>
                                        <h3 class="sidebar__post__content__title"><a
                                                href="{{ route('main.blog_view', ['slug' => 'test']) }}">Basic Rules of
                                                Running Web Agency business Solution</a></h3>
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
