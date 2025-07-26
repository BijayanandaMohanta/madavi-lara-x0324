@extends('main.layouts.main')
@section('title', 'Our Team')
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
    <!-- Team Start -->
    <section class="team-one" style="background-image: url({{ asset('main_assets') }}/images/shapes/team-bg-1.png);">
        <div class="container">
            <div class="row">
                @foreach($data as $value)
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 wow fadeInUp animated" data-wow-delay="200ms" style="visibility: visible; animation-delay: 200ms; animation-name: fadeInUp;">
                    <div class="team-one__item">
                        <div class="team-one__image">
                            <img src="{{ asset('uploads/' . $value->image) }}" alt="{{ $value->name }}">
                        </div>
                        <div class="team-one__content">
                            <h3 class="team-one__title">
                                <a href="javascript:void(0)">{{ $value->name }}</a>
                            </h3>
                            <span class="team-one__designation">{{ $value->designation }}</span>
                            <div class="team-one__social">
                                @if($value->facebook != '')
                                    <a href="{{ $value->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($value->linkedin != '')
                                    <a href="{{ $value->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if($value->youtube != '')
                                    <a href="{{ $value->youtube }}"><i class="fab fa-youtube"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <a href="https://api.whatsapp.com/send?phone=918985006262" class="btn-whmsg" target="_blank"><i class="fab fa-whatsapp"></i> Give Message</a>
                </div>
            </div>
        </div>
    </section>
@endsection
