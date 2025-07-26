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
                            <li>Store Gallery</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End-->
    <!-- Shop Category Area End -->
    <div class="mt-30px mb-40px">
        <div class="container-fluid">
            <div class="row">
                @foreach ($images as $image)
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="catergory-sec mb-4 storegallery">
                        <a href="{{ asset("uploads/gallery/$image->image") }}" data-fancybox="gallery">
                            <img src="{{ asset("uploads/gallery/$image->image") }}" class="img-fluid">
                        </a>
                    </div>
                </div>
                @endforeach
                
                
            </div>
        </div>
    </div>
    <!-- Brand area end -->
    <!-- Footer Area Start -->
@endsection
