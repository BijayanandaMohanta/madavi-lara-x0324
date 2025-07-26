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
                                <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Coupon</a></li>
                                <li class="breadcrumb-item active">Add Coupon</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Add Coupon
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
                                <h4 class="page-title">Add Coupon</h4>
                            </div>
                        </div>
                        <hr>
                        <form id="form" method="post" action="{{ route('coupon.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="code">Coupon Code * :</label>
                                        <input type="text" class="form-control @error('code') is-invalid @enderror"
                                            name="code" id="code" value="{{ old('code') }}"
                                            autocomplete="off">
                                        @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title* :</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" id="title" value="{{ old('title') }}"
                                            autocomplete="off">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description * :</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                            rows="5" autocomplete="off">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="discount_type">Offer Type</label>

                                        <select name="discount_type" class="form-control">
                                            <option value="">Select Offer Type</option>
                                            <option value="Flat Amount">Flat Amount</option>
                                            <option value="Percentage">Percentage</option>
                                        </select>
                                        @error('discount_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="offer_amount">Offer amount/percentage * :</label>
                                        <input type="text"
                                            class="form-control @error('offer_amount') is-invalid @enderror"
                                            name="offer_amount" id="offer_amount" value="{{ old('offer_amount') }}"
                                            autocomplete="off">
                                        @error('offer_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- add start date selection date --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date * :</label>
                                        <input type="date"
                                            class="form-control @error('start_date') is-invalid @enderror"
                                            name="start_date" id="start_date" value="{{ old('start_date') }}"
                                            autocomplete="off" min="{{ now()->format('Y-m-d') }}">
                                        @error('start_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- add end date selection date --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exp_date">End Date * :</label>
                                        <input type="date"
                                            class="form-control @error('exp_date') is-invalid @enderror" name="exp_date"
                                            id="exp_date" value="{{ old('exp_date') }}" autocomplete="off">
                                        @error('exp_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Category choose --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="categories">Categories :</label>
                                        <select class="form-control select2 @error('categories') is-invalid @enderror"
                                            name="categories[]" id="categories" multiple>
                                            <option value="" disabled>Select Categories</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                                    {!! $category->category !!}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('categories')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                {{-- Brand choose --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="brands">Brands :</label>
                                        <select class="form-control select2 @error('brands') is-invalid @enderror"
                                            name="brands[]" id="brands" multiple>
                                            <option value="" disabled>Select Brands</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->brand }}"
                                                    {{ in_array($brand->brand, old('brands', [])) ? 'selected' : '' }}>
                                                    {!! $brand->brand !!}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('brands')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Product choose --}}
                                <div class="col-md-12 d-none">
                                    <div class="form-group">
                                        <label for="products">Products :</label>
                                        <select class="form-control select2 @error('products') is-invalid @enderror"
                                            name="products[]" id="products" multiple>
                                            <option value="" disabled>Select Products</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ in_array($product->id, old('products', [])) ? 'selected' : '' }}>
                                                    {!! $product->name !!}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('products')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="uses_limit">Uses limit * :</label>
                                        <input type="number"
                                            class="form-control @error('uses_limit') is-invalid @enderror"
                                            name="uses_limit" id="uses_limit" value="{{ old('uses_limit') }}">
                                        @error('uses_limit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="min_amount">Minimum Order Amount :</label>
                                        <input type="number"
                                            class="form-control @error('min_amount') is-invalid @enderror"
                                            name="min_amount" id="min_amount" value="{{ old('min_amount') }}">
                                        @error('min_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="max_discount">Maximum Discount :</label>
                                        <input type="number"
                                            class="form-control @error('max_discount') is-invalid @enderror"
                                            name="max_discount" id="max_discount" value="{{ old('max_discount') }}">
                                        @error('max_discount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
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
                                    value="Create">
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet" />

{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.js"></script>

<style>
    .select2-selection__choice {
        background-color: #1f1f1f !important;
    }
</style>
<script>
    jQuery(document).ready(function($) {
        $('.select2').select2();
    });
</script>

<script>
    $(".select2").select2();

    $(".select2").on("select2:select", function(evt) {
        var element = evt.params.data.element;
        var $element = $(element);

        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });
</script>
@endsection
