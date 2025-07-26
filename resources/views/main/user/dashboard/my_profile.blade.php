@extends('main.layouts.main')
@section('content')
    <section class="accrodion-one dlyremind">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-lg-block d-none">
                    @include('main.layouts.dashboard-menu')
                </div>
                <div class="col-lg-9 profilebox">
                    <div class="d-flex justify-content-between">
                        <h4 class="pb-2">My Profile</h4>
                        <a href="student-full-profile.php" class="btn-back"><i class="fal fa-file-alt"></i> View Profile</a>
                    </div>
                    <form action="dashboard-myprofile-info-father.php">
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset>
                                    <legend>Basic Information</legend>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="star">Full Name</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6  col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="star">Email ID</label>
                                                <input type="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6  col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="star">City</label>
                                                <select name="" id="" class="form-select">
                                                    <option value="" hidden>-Select-</option>
                                                    <option value="">Visakhapatnam</option>
                                                    <option value="">Hyderabad</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="star">State</label>
                                                <select name="" id="" class="form-select">
                                                    <option value="" hidden>-Select-</option>
                                                    <option value="">Andhra Pradesh</option>
                                                    <option value="">Telangana</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="star">Country</label>
                                                <select name="" id="" class="form-select">
                                                    <option value="" hidden>-Select-</option>
                                                    <option value="">India</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6  col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="" class="star">WhatsApp No </label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6  col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="">Flat / House Number </label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6  col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="">Area / Locality / Street</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6  col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="">Landmark</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6  col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="">Pincode</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 pt-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn-continue">CONTINUE <i class="fal fa-chevron-circle-right"></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
