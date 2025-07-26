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
                            <li>FAQs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End-->
    <!-- Shop Category Area End -->
    <section class="mt-3 faq-section">
        <div class="container-fluid">
            <h2 class="mb-3">FAQs</h2>
            <div class="row justify-content-center">
                <div class="col-xxl-11 col-xl-11 col-lg-11">
                    <div class="accordion" id="accordionExample">
                        @forelse ($faqs as $key => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $key }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $key }}" aria-expanded="true"
                                        aria-controls="collapse{{ $key }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $key }}"
                                    class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                    aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {!! $faq->answer !!}
                                        <div class="img-block mt-3 mb-2">
                                            <div class="row">
                                                @foreach ($faq->faqimages as $faqimage)
                                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6"><img
                                                        src="{{ asset('uploads/faqs/' . $faqimage->image) }}" alt="" class="img-fluid">
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-primary">No FAQs found</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Category Area End -->
@endsection
