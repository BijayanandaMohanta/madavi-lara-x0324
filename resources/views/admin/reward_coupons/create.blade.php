@extends('admin.layouts.main')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('reward_coupons.index') }}">Reward Coupon</a></li>
                                <li class="breadcrumb-item active">Add Reward Coupon</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Add Reward Coupon
                    @endsection
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="page-title">Add Reward Coupon</h4>
                            </div>
                        </div>
                        <hr>
                        <form id="form" method="POST" action="{{ route('reward_coupons.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="min_amount">Min Amount * :</label>
                                        <input type="text" class="form-control @error('min_amount') is-invalid @enderror"
                                            name="min_amount" id="min_amount" value="{{ old('min_amount') }}"
                                            autocomplete="off">
                                        @error('min_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="discount_percentage">Discount Percentage * :</label>
                                        <input type="text" class="form-control @error('discount_percentage') is-invalid @enderror"
                                            name="discount_percentage" id="discount_percentage" value="{{ old('discount_percentage') }}"
                                            autocomplete="off">
                                        @error('discount_percentage')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="coupon_code">Coupon Code * :</label>
                                        <input type="text"
                                            class="form-control @error('coupon_code') is-invalid @enderror"
                                            name="coupon_code" id="coupon_code" value="{{ old('coupon_code') }}"
                                            autocomplete="off">
                                        @error('coupon_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="description" class="control-label">Description*</label>
                                        <textarea class="form-control autogrow @error('description') is-invalid @enderror" id="description" name="description"
                                            style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="status">Status * :</label>
                                            <select class="form-control @error('status') is-invalid @enderror" name="status"
                                                    id="status">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>



                            </div>

                            <div class="form-group mb-0">
                                <input type="submit" name="submit" id="save" class="btn btn-success"
                                    value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- end container-fluid -->
</div> <!-- end content -->
@endsection

@section('csscodes')
<link rel="stylesheet" href="{{ asset('admin_assets') . '/libs/dropify/dropify.min.css' }}">
@endsection
@section('jscodes')
<!-- Plugins js -->
<script src="{{ asset('admin_assets') . '/libs/dropify/dropify.min.js' }}"></script>

<!-- Init js-->
<script src="{{ asset('admin_assets') . '/js/pages/form-fileuploads.init.js' }}"></script>



@endsection

