@extends('main.layouts.main')
@section('title', 'Courses')
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
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 searchcourse">
                    <div class="input-group mb-3 input-group-lg">
                        <input type="text" class="form-control" placeholder="Search Course" aria-label="Search Course">
                        <button class="btn btn-secondary" type="button" id="button-addon2"><i class="fal fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="row coursebooks">
                <?php for($i=1;$i<=8;$i++) {?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <a href="{{ route('main.course_listing', ['slug' => 'test']) }}">
                        <div class="bookbox"> <img src="{{ asset('main_assets') }}/images/book-<?php echo $i;?>.jpg" alt="" class="img-fluid"></div>
                        <h4>Course Category Title</h4>
                    </a>
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
    </section>
@endsection

