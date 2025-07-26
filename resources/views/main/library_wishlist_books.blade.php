@extends('main.layouts.main')
@section('title', 'Library wishlist books')
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
                <div class="col-lg-3 col-md-5 searchcourse wow fadeInLeft" data-wow-delay="200ms">
                    <div class="input-group mb-3 input-group-lg">
                        <input type="text" class="form-control" placeholder="Search Course" aria-label="Search">
                        <button class="btn btn-secondary" type="button" id="button-addon2"><i class="fal fa-search"></i></button>
                    </div>
                    <div class="product__sidebar product__sidebar--left">
                        <div class="product__sidebar__single product__categories">
                            <h3 class="product__sidebar__title">Course Categories</h3>
                            <ul class="list-unstyled">
                                <li><a href="courses-listing.php">Arabic Speaking</a></li>
                                <li><a href="courses-listing.php">Islamic</a></li>
                                <li><a href="courses-listing.php">Reading Course</a></li>
                                <li><a href="courses-listing.php">Arabic Speaking</a></li>
                                <li><a href="courses-listing.php">Islamic</a></li>
                                <li><a href="courses-listing.php">Reading Course</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="row justify-content-center mb-3">
                        <div class="col-lg-4"><a href="library-wishlist-books.php" class="librarybtns active">Wishlist of Books</a></div>
                        <div class="col-lg-4"><a href="library-purchased-books.php" class="librarybtns">Purchased Books</a></div>
                    </div>
                    <div class="row">
                        <?php for($i=1;$i<=6;$i++) {?>
                        <div class="col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                            <div class="course-two__item">
                                <div class="course-two__thumb">
                                    <a href="#" class="wsh-icon"><i class="fas fa-heart"></i></a>
                                    <a href="courses-view.php"> <img src="{{ asset('main_assets') }}/images/arabic-<?php echo $i;?>.jpg" alt="alabrish"></a>
                                </div>
                                <div class="course-two__content text-center">
                                    <h3 class="course-two__title">
                                        <a href="courses-view.php">Arabic Speaking & Reading Course</a>
                                    </h3>
                                    <a href="{{ asset('main_assets') }}/images/dummy.pdf" download><div class="course-two__time pdfred"><i class="fal fa-file-pdf"></i> DOWNLOAD PDF</div></a>
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
