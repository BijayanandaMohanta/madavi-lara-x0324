@extends('main.layouts.main')
@section('title', 'Terms And Conditions')
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

                    <h5 class="mb-3">Introduction</h5>

                    <p>These Website Standard Terms and Conditions written on this webpage shall manage your use of our
                        website, Alabrishislamicacademy accessible at alabrishislamicacademy.org</p>

                    <p>These Terms will be applied fully and affect to your use of this Website. By using this Website,
                        you agreed to accept all terms and conditions written in here. You must not use this Website if
                        you disagree with any of these Website Standard Terms and Conditions.</p>

                    <p>Minors or people below 18 years old are not allowed to use this Website.</p>
                    <h5 class="mb-3">Intellectual Property Rights</h5>

                    <p>Other than the content you own, under these Terms, Alabrishislamicacademy and/or its licensors
                        own all the intellectual property rights and materials contained in this Website.</p>

                    <p>You are granted limited license only for purposes of viewing the material contained on this
                        Website.</p>

                    <h5 class="mb-3">Restrictions</h5>

                    <strong>You are specifically restricted from all of the following:</strong>
                    <ul class="mt-3">
                        <li>Publishing any Website material in any other media;</li>
                        <li>Selling, sublicensing and/or otherwise commercializing any Website material;</li>
                        <li>Publicly performing and/or showing any Website material;</li>
                        <li>Using this Website in any way that is or may be damaging to this Website;</li>
                        <li>Using this Website in any way that impacts user access to this Website;</li>
                        <li>Using this Website contrary to applicable laws and regulations, or in any way may cause harm
                            to the Website, or to any person or business entity;
                        </li>
                        <li>Engaging in any data mining, data harvesting, data extracting or any other similar activity
                            in relation to this Website;
                        </li>
                        <li>Using this Website to engage in any advertising or marketing.
                            Certain areas of this Website are restricted from being access by you and
                            Alabrishislamicacademy may further restrict access by you to any areas of this Website, at
                            any time, in absolute discretion. Any user ID and password you may have for this Website are
                            confidential and you must maintain confidentiality as well.
                        </li>
                    </ul>
                    <h5 class="mb-3">Your Content</h5>
                    <p>In these Website Standard Terms and Conditions, “Your Content” shall mean any audio, video text,
                        images or other material you choose to display on this Website. By displaying Your Content, you
                        grant Alabrishislamicacademy a non-exclusive, worldwide irrevocable, sub licensable license to
                        use, reproduce, adapt, publish, translate and distribute it in any and all media.</p>

                    <p>Your Content must be your own and must not be invading any third-party’s rights.
                        Alabrishislamicacademy reserves the right to remove any of Your Content from this Website at any
                        time without notice.</p>
                    <h5 class="mb-3">No warranties</h5>
                    <p>This Website is provided “as is,” with all faults, and Alabrishislamicacademy express no
                        representations or warranties, of any kind related to this Website or the materials contained on
                        this Website. Also, nothing contained on this Website shall be interpreted as advising you.</p>
                    <h5 class="mb-3">Limitation of liability</h5>

                    <p>In no event Alabrishislamicacademy, nor any of its officers, directors and employees, shall be
                        held liable for anything arising out of or in any way connected with your use of this Website
                        whether such liability is under contract. Alabrishislamicacademy, including its officers,
                        directors and employees shall not be held liable for any indirect, consequential or special
                        liability arising out of or in any way related to your use of this Website.</p>

                    <h5 class="mb-3">Indemnification</h5>

                    <p>You hereby indemnify to the fullest extent Alabrishislamicacademy from and against any and/or all
                        liabilities, costs, demands, causes of action, damages and expenses arising in any way related
                        to your breach of any of the provisions of these Terms.</p>

                    <h5 class="mb-3">Severability</h5>
                    <p>If any provision of these Terms is found to be invalid under any applicable law, such provisions
                        shall be deleted without affecting the remaining provisions herein.</p>

                    <h5 class="mb-3">Variation of Terms</h5>

                    <p>Alabrishislamicacademy is permitted to revise these Terms at any time as it sees fit, and by
                        using this Website you are expected to review these Terms on a regular basis.</p>

                    <h5 class="mb-3">Assignment</h5>
                    <p>The Alabrishislamicacademy is allowed to assign, transfer, and subcontract its rights and/or
                        obligations under these Terms without any notification. However, you are not allowed to assign,
                        transfer, or subcontract any of your rights and/or obligations under these Terms.</p>

                    <h5 class="mb-3">Entire Agreement</h5>
                    <p>These Terms constitute the entire agreement between Alabrishislamicacademy and you in relation to
                        your use of this Website, and supersede all prior agreements and understandings.</p>

                    <h5 class="mb-3">Governing Law & Jurisdiction</h5>

                    <p>These Terms will be governed by and interpreted in accordance with the laws of the State of in,
                        and you submit to the non-exclusive jurisdiction of the state and federal courts located in in
                        for the resolution of any disputes.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
