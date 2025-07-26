@extends('frontend.layouts.main')
@section('content')
    <div class="offcanvas-overlay"></div>
    <!-- Breadcrumb Area Start -->

    <div class="breadcrumb-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <ul class="nav">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li>Shop By Brand</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End-->

    <!-- Shop Category Area End -->
    <div class="shop-category-area">
        <div class="container-fluid searchresult">
            <div class="row">
                <div class="col-lg-12">
                    <div class="catgfilters"><a data-bs-toggle="collapse" href="#filterSidebar"><i
                                class="fas fa-sliders"></i> Category Filters</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-9 col-xl-9 col-lg-9 order-lg-last col-md-9 order-md-last">
                    <!-- Shop Bottom Area Start -->
                    <div class="shop-bottom-area mt-35">
                        <div class="search-result-title">
                            <h3 class="blue">Shop By Brand</h3>
                        </div>
                        <div class="row row-cols-lg-7 row-cols-xl-9 row-cols-xxl-9 brandshop">
                            @foreach ($brands as $brand)
                                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-3 col-6 mb-4">
                                    <div class="brand-slider-item">
                                        <a href="{{ route('shopbybrandlist', $brand->slug) }}"><img
                                                src="https://images.weserv.nl/?url={{ asset("uploads/brand/$brand->image") }}&w=200&h=200"
                                                alt="{{ $brand->brand }}"></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-3 order-lg-first1 col-md-12 order-md-0 order-first mb-md-60px mb-lm-60px filtersidebar collapse collapse-horizontal"
                    id="filterSidebar">
                    <div class="d-lg-block">
                        @include('frontend.brand-filters')
                    </div>
                </div>
            </div>
            <!-- Sidebar Area Start -->
            <!-- Shop Category Area End -->
        </div>
        <!-- Footer Area Start -->
    @endsection
