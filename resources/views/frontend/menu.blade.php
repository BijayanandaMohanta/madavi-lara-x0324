@extends('frontend.layouts.main')
@section('content')
    

    <div class="rts-navigation-area-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navigator-breadcrumb-wrapper">
                        <a href="{{route('home')}}">Home</a>
                        <i class="fa-regular fa-chevron-right"></i>
                        <a class="current" href="#">Menu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



 



    <!-- about area start -->
    <div class="rts-service-area rts-section-gap2 bg_light-1">
        <div class="container-3">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="{{asset('frontend/assets')}}/images/menu-front.jpg" alt="" class="w-100">
                </div>
                <div class="col-lg-6">
                    <img src="{{asset('frontend/assets')}}/images/menu-back.jpg" alt="" class="w-100">
                </div>
            </div>
        </div>
    </div>
   
@endsection