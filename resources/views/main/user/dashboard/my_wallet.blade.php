@extends('main.layouts.main')
@section('content')
    <section class="accrodion-one dlyremind">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-lg-block d-none">
                    @include('main.layouts.dashboard-menu')
                </div>
                <div class="col-lg-9">
                    <h4 class="pb-1">My Wallet</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="walletblcok">
                                <div class="row justify-content-between">
                                    <div class="col-lg-5 col-md-6 col-sm-6 col-7">
                                        <div class="d-flex">
                                            <div class="walleticon"><i class="fal fa-wallet"></i></div>
                                            <div class="walletcontent align-self-center">
                                                <p>Balance</p>
                                                <h4><i class="fal fa-rupee-sign"></i> 14,050</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-5 align-self-center">
                                        <a href="#addcashModal" data-bs-toggle="modal" class="btn-addcash">ADD CASH</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-2 walletfilter">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="">From Date</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <label for="">To Date</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3  col-md-4 col-sm-6">
                            <label for="">Transaction Type</label>
                            <select class="form-select">
                                <option value="">-Select-</option>
                                <option value="">Debit</option>
                                <option value="">Credit</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-1 trstableheader">
                        <div class="col-lg-4 col-md-4 col-sm-4">Transaction ID & Date</div>
                        <div class="col-lg-4 col-md-4 col-sm-4">Transaction Detils</div>
                        <div class="col-lg-4 col-md-4 col-sm-4">Amount</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-2">
                                <div class="card-body p-2">
                                    <div class="row trscrow">
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-12"><p class="reshead"><strong>Transaction
                                                    ID & Date</strong></p><h5>#256484</h5>
                                            <p><span>Jan30, 2021</span></p></div>
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-6"><p class="reshead"><strong>Transaction
                                                    Detils</strong></p>
                                            <p>Courses Purchased</p></div>
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-6"><p class="reshead">
                                                <strong>Amount</strong></p>
                                            <p class="amount">-<i class="fal fa-rupee-sign"></i> 1000</p>
                                            <p class="text-danger">Debit</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card mb-2">
                                <div class="card-body p-2">
                                    <div class="row trscrow">
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-12"><p class="reshead"><strong>Transaction
                                                    ID & Date</strong></p><h5>#256484</h5>
                                            <p><span>Jan30, 2021</span></p></div>
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-6"><p class="reshead"><strong>Transaction
                                                    Detils</strong></p>
                                            <p>Courses Purchased</p></div>
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-6"><p class="reshead">
                                                <strong>Amount</strong></p>
                                            <p class="amount">-<i class="fal fa-rupee-sign"></i> 1000</p>
                                            <p class="text-success">Credit</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card mb-2">
                                <div class="card-body p-2">
                                    <div class="row trscrow">
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-12"><p class="reshead"><strong>Transaction
                                                    ID & Date</strong></p><h5>#256484</h5>
                                            <p><span>Jan30, 2021</span></p></div>
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-6"><p class="reshead"><strong>Transaction
                                                    Detils</strong></p>
                                            <p>Courses Purchased</p></div>
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-6"><p class="reshead">
                                                <strong>Amount</strong></p>
                                            <p class="amount">-<i class="fal fa-rupee-sign"></i> 1000</p>
                                            <p class="text-danger">Debit</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card mb-2">
                                <div class="card-body p-2">
                                    <div class="row trscrow">
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-12"><p class="reshead"><strong>Transaction
                                                    ID & Date</strong></p><h5>#256484</h5>
                                            <p><span>Jan30, 2021</span></p></div>
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-6"><p class="reshead"><strong>Transaction
                                                    Detils</strong></p>
                                            <p>Courses Purchased</p></div>
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-6"><p class="reshead">
                                                <strong>Amount</strong></p>
                                            <p class="amount">-<i class="fal fa-rupee-sign"></i> 1000</p>
                                            <p class="text-success">Credit</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card mb-2">
                                <div class="card-body p-2">
                                    <div class="row trscrow">
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-12"><p class="reshead"><strong>Transaction
                                                    ID & Date</strong></p><h5>#256484</h5>
                                            <p><span>Jan30, 2021</span></p></div>
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-6"><p class="reshead"><strong>Transaction
                                                    Detils</strong></p>
                                            <p>Courses Purchased</p></div>
                                        <div class="ol-lg-4 col-md-4 col-sm-4 col-6"><p class="reshead">
                                                <strong>Amount</strong></p>
                                            <p class="amount">-<i class="fal fa-rupee-sign"></i> 1000</p>
                                            <p class="text-danger">Debit</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--add-cash-modal-->
    <!-- Modal -->
    <div class="modal fade" id="addcashModal" tabindex="-1" aria-labelledby="addcashModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addcashModalLabel">Add Amount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="">Enter Your Amount</label>
                            <input type="text" class="form-control input-lg">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-amount">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--add-cash-modal-->
@endsection
