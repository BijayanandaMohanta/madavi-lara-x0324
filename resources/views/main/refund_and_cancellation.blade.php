@extends('main.layouts.main')
@section('title', 'Refund and Cancellation')
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

    <style>
        .content-section ul li {
            line-height: 35px;
            font-size: 14px;
            letter-spacing: 1px;
            color: #333;
        }
    </style>

    <section class="about-two about-two--about mt-2 content-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 cms-content">
                    <h5 class="mb-3">Refund Policy:</h5>
                    <p>We at Alabrishislamicacademy strive to ensure the satisfaction and convenience of all our participants. If, for any reason, you are dissatisfied with our services, we offer a refund within a specified period of time from the date of enrollment. Please note the following conditions for a refund:</p>

                    <ol class="mt-3">
                        <li>Requests for a refund must be made within 14 days from the date of enrollment.</li>
                        <li>The reason for the refund request must be clearly stated and must adhere to the terms and conditions of the course.</li>
                        <li>Refunds will be processed within [specify time frame] from the date of approval.</li>
                    </ol>

                    <h5 class="mb-3">Cancellation Policy:</h5>

                    <p>In the event that a participant wishes to cancel their enrollment in any of our programs, the following terms and conditions apply:</p>

                    <ol>
                        <li>Participants must submit a cancellation request in writing within 14 days from the date of enrollment.</li>
                        <li>Cancellation requests made after the stipulated time frame may not be honored.</li>
                        <li>Any services already rendered or materials provided prior to the cancellation request may not be eligible for a refund.</li>
                        <li>Alabrishislamicacademy reserves the right to modify or cancel any program or course due to unforeseen circumstances. In such cases, participants will be notified in a timely manner, and alternative arrangements may be offered.</li>
                    </ol>

                    <p>For any queries or concerns regarding our refund and cancellation policy, please reach out to us at “info@abrish.com”</p>

                    <p>Alabrishislamicacademy values your support and understanding, and we are dedicated to providing the best possible experience for all our participants.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
