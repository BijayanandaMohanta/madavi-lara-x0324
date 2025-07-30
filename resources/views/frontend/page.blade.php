@extends('frontend.layouts.main')
@section('content')
    <div class="rts-navigation-area-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="navigator-breadcrumb-wrapper">
                        <a href="{{ route('home') }}">Home</a>
                        <i class="fa-regular fa-chevron-right"></i>
                        <a class="current" href="#">{{ $data->name }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <!-- about area start -->
    <div class="rts-map-contact-area rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {!! $data->description !!}
                </div>
            </div>
        </div>
    </div>
@endsection
