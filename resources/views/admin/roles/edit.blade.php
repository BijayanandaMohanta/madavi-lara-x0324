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
                                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                                <li class="breadcrumb-item active">Edit Role</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Edit Role
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
                                <h4 class="page-title">Edit Role</h4>
                            </div>
                        </div>
                        <hr>
                        <form id="form" method="post" action="{{ route('roles.update', $data->id) }}"
                            enctype="multipart/form-data">@csrf @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name * :</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" value="{{ $data->name }}" autocomplete="off">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="privileges">Privileges * :</label> <br>
                                        @php
                                        $privileges = explode(',',$data->privileges);
                                        @endphp
                                        <div class="priv">
                                            <div>
                                                <h5>Content</h5>
                                                <input type="checkbox" name="privileges[]" id="banners" value="banners" 
                                                {{ in_array('banners', old('privileges', $privileges)) ? 'checked' : '' }}> Banners <br>
                                                <input type="checkbox" name="privileges[]" id="pages" value="pages"
                                                {{ in_array('pages', old('privileges', $privileges)) ? 'checked' : '' }}> Pages <br>
                                                <input type="checkbox" name="privileges[]" id="ads" value="ads"
                                                {{ in_array('ads', old('privileges', $privileges)) ? 'checked' : '' }}
                                                > Ads <br>
                                                <input type="checkbox" name="privileges[]" id="videoreviews" value="videoreviews"
                                                {{ in_array('videoreviews', old('privileges', $privileges)) ? 'checked' : '' }}
                                                > Video Reviews <br>
                                                <input type="checkbox" name="privileges[]" id="testimonial" value="testimonial"
                                                {{ in_array('testimonial', old('privileges', $privileges)) ? 'checked' : '' }}
                                                > Testimonials <br>
                                                <input type="checkbox" name="privileges[]" id="store_gallery" value="store_gallery"
                                                {{ in_array('store_gallery', old('privileges', $privileges)) ? 'checked' : '' }}
                                                > Store gallery <br>
                                            </div>
                                            <div>
                                                <h5>Category</h5>
                                                <input type="checkbox" name="privileges[]" id="categories" value="categories"
                                                {{ in_array('categories', old('privileges', $privileges)) ? 'checked' : '' }}> Categories <br>
                                                <input type="checkbox" name="privileges[]" id="scategories" value="scategories"
                                                    {{ in_array('scategories', old('privileges', $privileges)) ? 'checked' : '' }}> Sub Categories <br>
                                                <input type="checkbox" name="privileges[]" id="ccategories" value="ccategories"
                                                    {{ in_array('ccategories', old('privileges', $privileges)) ? 'checked' : '' }}> Child Categories <br>
                                            </div>
                                            <div>
                                                <h5>Product</h5>
                                                <input type="checkbox" name="privileges[]" id="product" value="product"
                                                    {{ in_array('product', old('privileges', $privileges)) ? 'checked' : '' }}> Product <br>
                                                <input type="checkbox" name="privileges[]" id="orders" value="orders"
                                                    {{ in_array('orders', old('privileges', $privileges)) ? 'checked' : '' }}> Orders <br>
                                                <input type="checkbox" name="privileges[]" id="tele_orders" value="tele_orders"
                                                    {{ in_array('tele_orders', old('privileges', $privileges)) ? 'checked' : '' }}> Offline Orders <br>
                                                <input type="checkbox" name="privileges[]" id="coupon" value="coupon"
                                                    {{ in_array('coupon', old('privileges', $privileges)) ? 'checked' : '' }}> Coupon <br>
                                                <input type="checkbox" name="privileges[]" id="notify" value="notify"
                                                    {{ in_array('notify', old('privileges', $privileges)) ? 'checked' : '' }}> Notify <br>
                                                <input type="checkbox" name="privileges[]" id="newsletter" value="newsletter"
                                                    {{ in_array('newsletter', old('privileges', $privileges)) ? 'checked' : '' }}> Newsletter <br>
                                            </div>
                                            <div>
                                                <h5>Report</h5>
                                                <input type="checkbox" name="privileges[]" id="order_report" value="order_report"
                                                    {{ in_array('order_report', old('privileges', $privileges)) ? 'checked' : '' }}> Orders Report<br>
                                                <input type="checkbox" name="privileges[]" id="stocks_report" value="stocks_report"
                                                    {{ in_array('stocks_report', old('privileges', $privileges)) ? 'checked' : '' }}> Stocks Report <br>
                                                <input type="checkbox" name="privileges[]" id="best_selling_products_report" value="best_selling_products_report"
                                                    {{ in_array('best_selling_products_report', old('privileges', $privileges)) ? 'checked' : '' }}> Best Selling Products Report <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                            <option value="1" {{ old('status', $data->status) == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $data->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <input type="submit" name="submit" id="save" class="btn btn-success"
                                            value="Update">
                                    </div>
                                </div>
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
<style>
    .priv{
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    }
</style>
@endsection
@section('jscodes')
<!-- Plugins js -->
<script src="{{ asset('admin_assets') . '/libs/dropify/dropify.min.js' }}"></script>

<!-- Init js-->
<script src="{{ asset('admin_assets') . '/js/pages/form-fileuploads.init.js' }}"></script>
@endsection
