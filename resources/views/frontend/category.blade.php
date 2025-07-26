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
                            <li><a href="index.php">Home</a></li>
                            <li>{{$category->category}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End-->
    <!-- Shop Category Area End -->
    @foreach ($subcategories as $subcategory)
    <div class="shop-category-area mt-30px">
        <div class="container-fluid">
            <h4 class="blue mb-3">{{$subcategory->category}}</h4>
            <div class="row">
                @foreach ($subcategory->childcategories as $child_category)
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                    <div class="catergory-sec">
                        <a href="{{route('childcategorylist',$child_category->slug)}}">
                            <img src="{{asset("uploads/ccategory/$child_category->image")}}" class="img-fluid">
                        </a>
                    </div>
                    <h6>{{$child_category->category}}</h6>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
    <!-- Shop Category Area End -->

    <!-- Brand area start -->
    @include ('frontend.brandscroll')
    <!-- Brand area end -->
    <!-- Footer Area Start -->
@endsection
