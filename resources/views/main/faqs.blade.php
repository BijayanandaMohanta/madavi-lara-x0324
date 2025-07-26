@extends('main.layouts.main')
@section('title', "FAQ's")
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
    <section class="accrodion-one">
        <div class="container">
            <div class="section-title  text-center">
                <h5 class="section-title__tagline">
                    Our Recent FAQS
                    <svg class="arrow-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55 13">
                        <g clip-path="url(#clip0_324_36194)">
                            <path
                                d="M10.5406 6.49995L0.700562 12.1799V8.56995L4.29056 6.49995L0.700562 4.42995V0.819946L10.5406 6.49995Z"/>
                            <path
                                d="M25.1706 6.49995L15.3306 12.1799V8.56995L18.9206 6.49995L15.3306 4.42995V0.819946L25.1706 6.49995Z"/>
                            <path
                                d="M39.7906 6.49995L29.9506 12.1799V8.56995L33.5406 6.49995L29.9506 4.42995V0.819946L39.7906 6.49995Z"/>
                            <path
                                d="M54.4206 6.49995L44.5806 12.1799V8.56995L48.1706 6.49995L44.5806 4.42995V0.819946L54.4206 6.49995Z"/>
                        </g>
                    </svg>
                </h5>
                <h2 class="section-title__title">Frequently Asked Question & <br>Answers Here</h2>
            </div>
            <div class="accrodion-one__wrapper eduact-accrodion" data-grp-name="eduact-accrodion">
                @foreach($data as $key => $value)
                <div class="accrodion @if($key == 0) active @endif">
                    <span class="accrodion__icon"></span>
                    <div class="accrodion-title">
                        <h4>{{ $value->question }}</h4>
                    </div>
                    <div class="accrodion-content">
                        <div class="inner">
                            {!! $value->answer !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
