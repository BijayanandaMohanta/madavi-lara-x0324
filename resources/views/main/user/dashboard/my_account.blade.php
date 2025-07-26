@extends('main.layouts.main')
@section('content')
    <section class="accrodion-one dlyremind">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-lg-block d-none">
                    @include('main.layouts.dashboard-menu')
                </div>
                <div class="col-lg-9">
                    <h4 class="pb-1">My Account</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="walletblcok">
                                <div class="row justify-content-between">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 align-self-center">
                                        <p class="mb-0"><strong>Welcome Student / Teacher</strong></p>
                                        <p class="mb-0"><small>Last Loin Date & Time : 22-09-2023, 3:38 PM</small></p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                        <div class="d-flex">
                                            <div class="walleticon"><i class="fal fa-wallet"></i></div>
                                            <div class="walletcontent align-self-center">
                                                <p>Balance</p>
                                                <h4><i class="fal fa-rupee-sign"></i> 14,050</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
