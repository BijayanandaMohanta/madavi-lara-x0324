@extends('main.layouts.main')
@section('content')
    <section class="accrodion-one dlyremind">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-lg-block d-none">
                    @include('main.layouts.dashboard-menu')
                </div>
                <div class="col-lg-9">
                    <h4 class="pb-1">Notifications</h4>
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="card">
                                <div class="card-body  p-2">
                                    <div class="d-flex notifybox">
                                        <div class="notimg"><img src="{{ asset('main_assets') }}/images/hampericon.png" alt=""></div>
                                        <div class="noticontent align-self-center">
                                            <h4><i class="fal fa-star active"></i> Invite your Friend to Ala Abrish and
                                                win cashback</h4>
                                            <p>2 days ago</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php for ($i = 1;
                                   $i <= 4;
                                   $i++) { ?>
                        <div class="col-lg-12 mb-2">
                            <div class="card">
                                <div class="card-body  p-2">
                                    <div class="d-flex notifybox">
                                        <div class="notimg"><img src="{{ asset('main_assets') }}/images/hampericon.png" alt=""></div>
                                        <div class="noticontent align-self-center">
                                            <h4><i class="fal fa-star"></i> Invite your Friend to Ala Abrish and win
                                                cashback</h4>
                                            <p>2 days ago</p>
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
