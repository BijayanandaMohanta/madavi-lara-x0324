@extends('main.layouts.main')
@section('content')
    <section class="accrodion-one dlyremind">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-lg-block d-none">
                    @include('main.layouts.dashboard-menu')
                </div>
                <div class="col-lg-9">
                    <h4 class="pb-1">My Courses</h4>
                    <div class="row">
                        <?php for($i=1;$i<=6;$i++) {?>
                        <div class="col-lg-6 wow fadeInUp" data-wow-delay="100ms">
                            <div class="course-two__item dshcourse">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-4">
                                        <div class="course-two__thumb">
                                            <a href="courses-view.php"> <img src="{{ asset('main_assets') }}/images/arabic-<?php echo $i;?>.jpg" alt="alabrish"></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-8 align-self-center">
                                        <div class="course-two__content">
                                            <div class="course-two__time"><i class="fal fa-video"></i> Videos</div>
                                            <div class="course-two__time"><i class="fal fa-file"></i> Files</div>
                                            <h3 class="course-two__title">
                                                <a href="courses-view.php">Arabic Speaking & Reading Course</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
