@extends('frontend.layouts.main')
@section('content')
    <div class="dashboardlayout">
        <div class="container-fluid pt-4 pb-4">
            <div class="row">
                <div class="col-xxl-3 col-xl-3 col-lg-3 d-xxl-block d-xl-block d-lg-block d-none">
                    @include('frontend.dashboardmenu')
                </div>
                <div class="col-xxl-9 col-xl-9 col-lg-9">
                    <div class="row">
                        <div class="col-xxl-12 col-x-12 col-lg-12">
                            <div class="dashwidget">
                                <h3>Reward’s Box</h3>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-x-12 col-lg-12 rwdbox">
                            <div class="dashwidget p-5">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                        <div class="rewardbox">
                                            <p>Purchased</p>
                                            @php
                                                $progress = ($total_orders_amount / ($reward_coupon->min_amount ?? 1)) * 100;
                                                $progress = $progress > 100 ? 100 : $progress; // Ensure the progress does not exceed 100%
                                                if ($total_orders_amount >= ($reward_coupon->min_amount ?? 1)) {
                                                    $available_coupon = true;
                                                } else {
                                                    $available_coupon = false;
                                                }
                                            @endphp
                                            <div class="progress" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: {{ $progress }}%"></div>
                                            </div>
                                            <div class="valuecounter">
                                                <p>Rs. {{ $total_orders_amount ?? 0 }}</p>
                                                <p>Rs. {{ $reward_coupon->min_amount ?? 0 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                        <div class="rewardbox">
                                            <p>Saved</p>
                                            <h4>Rs. {{ $total_savings ?? 0 }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                        <div class="rewardbox">
                                            <p>Rewards Redeemed</p>
                                            <h4>Rs.{{$total_redeem_amount ?? 0}}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end py-3 dshcouponborder">
                                    {{-- <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12">
                                        <div class="lineprogress complete"></div>
                                        <div class="couponrewardbox disable">
                                            <div class="row">
                                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
                                                    <h3>20%</h3>
                                                    <h4>DISCOUNT</h4>
                                                </div>
                                                <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 align-self-center">
                                                    <p>Reach this milestone of Rs.10,000 to grab the below coupon code</p>
                                                    <input type="text" value="OPENBOX20DIS" id="coupon-code1" readonly>
                                                    <div class="claimcouppon">
                                                        <i class="fas fa-check-circle"></i>
                                                        <p>Coupon <br>claimed</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12">
                                        <div class="lineprogress"></div>
                                        <div class="couponrewardbox">
                                            <div class="row">
                                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
                                                    <h3>10%</h3>
                                                    <h4>DISCOUNT</h4>
                                                </div>
                                                <div class="col-lg-8 col-xl-8 col-lg-8 col-md-8 align-self-center">
                                                    <p>Reach this milestone of Rs.10,000 to grab the below coupon code</p>
                                                    <input type="text" value="OPENBOX10DIS" id="coupon-code" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    @foreach ($reward_coupons as $coupon)
                                        <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12">
                                            <div class="lineprogress"></div>
                                            <div
                                                class="couponrewardbox
                                                {{ $coupon->coupon_code == $reward_coupon->coupon_code && $available_coupon && $coupon_applied == false ? '' : 'disable' }}">
                                                <div class="row">
                                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
                                                        <h3>{{ $coupon->discount_percentage }}</h3>
                                                        <h4>DISCOUNT</h4>
                                                    </div>
                                                    <div class="col-xl-8 col-lg-8 col-md-8 align-self-center">
                                                        <p>{{ $coupon->description }}
                                                        </p>
                                                        <input type="text"
                                                            value="{{ $coupon->coupon_code == $reward_coupon->coupon_code && $available_coupon && $coupon_applied == false ? $coupon->coupon_code : 'COUPONXXXXXX' }}"
                                                            id="coupon-code" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
