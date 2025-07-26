@extends('main.layouts.main')
@section('title', 'Course View')
@section('content')
    <section class="course-details">
        <div class="container" id="main-content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="course-details__thumb">
                        <img src="{{ asset('main_assets') }}/images/courseview.jpg" alt="eduact" />
                    </div>
                    <div class="course-details__meta">
                        <div class="course-details__meta__author">
                            <h5 class="course-details__meta__name">Module Course Arabic</h5>
                            <p class="course-details__meta__designation">Duration: 40 days</p>
                        </div>
                        <div class="course-details__meta__price"><i class="fal fa-rupee-sign"></i> 473</div>
                    </div>
                    <h3 class="course-details__title">40 Days Intensive Tajweed & Makhraj Course</h3>
                    <div class="course-details__tabs tabs-box">
                        <ul class="course-details__tabs__lists tab-buttons list-unstyled">
                            <li data-tab="#aboutus" class="tab-btn active-btn"><span>About</span></li>
                            <li data-tab="#rec" class="tab-btn"><span>Rec</span></li>
                            <li data-tab="#liveclass" class="tab-btn"><span>Live Class</span></li>
                            <li data-tab="#exams" class="tab-btn"><span>Exams</span></li>
                        </ul>
                        <div class="tabs-content">
                            <div class="tab active-tab fadeInUp animated" id="aboutus">
                                <div class="course-details__overview">
                                    <h4>Course Highlights</h4>
                                    <ul class="list-unstyled course-details__overview__lists">
                                        <li>Nam at elit nec neque suscipit gravida.</li>
                                        <li>2+ hours on-demand content</li>
                                        <li>12+ hours Live Interactive Sessions</li>
                                        <li>6+ hours Live Trading Sessions</li>
                                        <li>Q&A Session with the Expert</li>
                                        <li>WhatsApp Community Support</li>
                                        <li>Certificate of Completion</li>
                                    </ul>
                                    <h4>Description</h4>
                                    <div class="crsviewbox">
                                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it
                                            over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia </p>
                                        <p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero,
                                            written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section.</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum, fugit veritatis alias quaerat doloremque quasi ut voluptatum, ullam suscipit provident reiciendis. Mollitia, ab laboriosam? Maxime distinctio repellat officia quisquam quidem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, temporibus itaque quasi atque pariatur sequi obcaecati nam totam magnam excepturi libero, aliquid necessitatibus ullam omnis esse beatae natus eum expedita?</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum, fugit veritatis alias quaerat doloremque quasi ut voluptatum, ullam suscipit provident reiciendis. Mollitia, ab laboriosam? Maxime distinctio repellat officia quisquam quidem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, temporibus itaque quasi atque pariatur sequi obcaecati nam totam magnam excepturi libero, aliquid necessitatibus ullam omnis esse beatae natus eum expedita?</p>
                                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illum, fugit veritatis alias quaerat doloremque quasi ut voluptatum, ullam suscipit provident reiciendis. Mollitia, ab laboriosam? Maxime distinctio repellat officia quisquam quidem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, temporibus itaque quasi atque pariatur sequi obcaecati nam totam magnam excepturi libero, aliquid necessitatibus ullam omnis esse beatae natus eum expedita?</p>
                                    </div>
                                    <p><a href="javascript:void()" class="readlink">Readmore <i class="fal fa-angle-right"></i></a></p>
                                </div>
                            </div>
                            <div class="tab fadeInUp animated" id="rec">
                                <div class="course-details__curriculum">
                                    <ul class="list-unstyled course-details__curriculum__lists">
                                        <li>
                                            <a href="https://www.youtube.com/watch?v=AvV7e_z_6iU" class="video-popup">
                                                <i class="icon-play-border"></i>
                                                <span class="course-details__curriculum__lists__title">Introduction</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.youtube.com/watch?v=AvV7e_z_6iU" class="video-popup">
                                                <i class="icon-play-border"></i>
                                                <span class="course-details__curriculum__lists__title">Chapter-01</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.youtube.com/watch?v=AvV7e_z_6iU" class="video-popup">
                                                <i class="icon-play-border"></i>
                                                <span class="course-details__curriculum__lists__title">Chapter-02</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.youtube.com/watch?v=AvV7e_z_6iU" class="video-popup">
                                                <i class="icon-play-border"></i>
                                                <span class="course-details__curriculum__lists__title">Chapter-03</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="tab fadeInUp animated" id="liveclass">
                                <div class="course-details__comment">
                                    <div class="accrodion-one__wrapper eduact-accrodion" data-grp-name="eduact-accrodion">
                                        <div class="accrodion active">
                                            <span class="accrodion__icon"></span>
                                            <div class="accrodion-title">
                                                <h4>Chapter - 01 ( Aug 20, 2023 )</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p><strong>1. Inter Market Analysis</strong></p>
                                                    <p><i class="fal fa-calendar-alt"></i> Aug 12 ,2023 | <i class="fal fa-clock"></i> 05:00 PM To 08:00 PM</p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia ducimus blanditiis tenetur, alias atque reprehenderit corporis aliquam rem mollitia eum, possimus dolores est nostrum facilis at doloribus, unde cumque modi! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea quibusdam alias ratione in culpa? Minima consequuntur dolore quod asperiores qui, laboriosam alias, iusto neque ducimus ipsum minus nisi ratione consequatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accrodion">
                                            <span class="accrodion__icon"></span>
                                            <div class="accrodion-title">
                                                <h4>Chapter - 02 ( Aug 20, 2023 )</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p><strong>1. Inter Market Analysis</strong></p>
                                                    <p><i class="fal fa-calendar-alt"></i> Aug 12 ,2023 | <i class="fal fa-clock"></i> 05:00 PM To 08:00 PM</p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia ducimus blanditiis tenetur, alias atque reprehenderit corporis aliquam rem mollitia eum, possimus dolores est nostrum facilis at doloribus, unde cumque modi! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea quibusdam alias ratione in culpa? Minima consequuntur dolore quod asperiores qui, laboriosam alias, iusto neque ducimus ipsum minus nisi ratione consequatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accrodion">
                                            <span class="accrodion__icon"></span>
                                            <div class="accrodion-title">
                                                <h4>Chapter - 03 ( Aug 20, 2023 )</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p><strong>1. Inter Market Analysis</strong></p>
                                                    <p><i class="fal fa-calendar-alt"></i> Aug 12 ,2023 | <i class="fal fa-clock"></i> 05:00 PM To 08:00 PM</p>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia ducimus blanditiis tenetur, alias atque reprehenderit corporis aliquam rem mollitia eum, possimus dolores est nostrum facilis at doloribus, unde cumque modi! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea quibusdam alias ratione in culpa? Minima consequuntur dolore quod asperiores qui, laboriosam alias, iusto neque ducimus ipsum minus nisi ratione consequatur.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab fadeInUp animated" id="exams">
                                <div class="course-details__overview">
                                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it
                                        over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia</p>
                                    <h4>Procedure:</h4>
                                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it
                                        over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia</p>
                                    <h4>Other Details:</h4>
                                    <ul class="list-unstyled course-details__overview__lists">
                                        <li>Duration: 30 minutes</li>
                                        <li>Pattern of Questions: Multiple choice-based questions of 2 marks each.</li>
                                        <li>No Negative Marking</li>
                                        <li>Qualifying Marks: 60%</li>
                                    </ul>
                                    <h4>Certificate of Completion*:</h4>
                                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it
                                        over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div id="sidebar" class="mb-3">
                        <div class="course-details__sidebar" style="min-height:600px">
                            <div class="course-details__sidebar__item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="courseprice-new">
                                        <h4><i class="fal fa-rupee-sign"></i> 473</h4>
                                        <h5><del><i class="fal fa-rupee-sign"></i> 1500</del> <span>30% Discount</span></h5>
                                    </div>
                                    <div class="buynow-btn">
                                        <a href="#" class="showbuybox">BUY NOW</a>
                                    </div>
                                </div>
                            </div>
                            <div class="afterbuybox" style="display:none;">
                                <div class="course-details__sidebar__item mt-3">
                                    <p>COUPONS</p>
                                    <h3 class="course-details__sidebar__title pb-0">
                                        <a href="#couponModal" data-bs-toggle="modal">
                                            <div class="d-flex justify-content-between">
                                                <div class="leftcon"><i class="fal fa-badge-percent"></i> Apply Coupon</div>
                                                <div class="ltarrow"><i class="fal fa-angle-right fa-lg"></i></div>
                                            </div>
                                        </a>
                                    </h3>
                                </div>
                                <div class="course-details__sidebar__item">
                                    <ul class="course-details__sidebar__lists clerfix">
                                        <li>PRICE DETAILS ( 2 items )</li>
                                        <li>Total MRP <span><i class="fal fa-rupee-sign"></i> 600</span></li>
                                        <li>Discount on MRP<span><i class="fal fa-rupee-sign"></i> 600</span></li>
                                        <li>Coupon Discount <span><a href="#couponModal" data-bs-toggle="modal">Apply Coupon</a></span></li><hr>
                                        <li><strong>Total Amount</strong> <span class="fz-20"><i class="fal fa-rupee-sign"></i> 600</span></li>
                                    </ul>
                                    <p class="text-center m-0 pb-1">1 Course Selected</p>
                                    <a href="#" class="abrish-btn abrish-btn-second mt-0"><span class="abrish-btn__curve"></span>PLACE ORDER<i class="icon-arrow"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--coupon-modal-start-->
    <!-- Modal -->
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="couponModalLabel">Coupons</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Enter Coupon Code">
                                <button class="btn btn-primary">CHECK</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cstchkbox">
                                <input type="checkbox" name="coupon-1" id="coupon-1" checked>
                                <label for="coupon-1">ALAAB200</label>
                            </div>
                            <div class="couponcontent">
                                <p>Save <i class="fal fa-rupee-sign"></i> 200</p>
                                <p>Rs.200 off on minimum purchase of Rs.1500.</p>
                                <p>Expires on : 31 st December 2023</p>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <div class="cstchkbox">
                                <input type="checkbox" name="coupon-2" id="coupon-2">
                                <label for="coupon-2">ALAAB300</label>
                            </div>
                            <div class="couponcontent">
                                <p>Save <i class="fal fa-rupee-sign"></i> 300</p>
                                <p>Rs.300 off on minimum purchase of Rs.3000.</p>
                                <p>Expires on : 31 st December 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
