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
                                <li class="breadcrumb-item active">Add Role</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Add Role
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
                                <h4 class="page-title">Add Role</h4>
                            </div>
                        </div>
                        <hr>
                        <form id="form" method="post" action="{{ route('roles.store') }}"
                            enctype="multipart/form-data">@csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name * :</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" value="{{ old('name') }}" autocomplete="off">
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
                                        <div class="priv">
                                            <div>
                                                <h5>Content</h5>
                                                <input type="checkbox" name="privileges[]" id="banners" value="banners"> Banners <br>
                                                <input type="checkbox" name="privileges[]" id="pages" value="pages"> Pages <br>
                                                <input type="checkbox" name="privileges[]" id="ads" value="ads"> Ads <br>
                                                <input type="checkbox" name="privileges[]" id="videoreviews" value="videoreviews"> Video Reviews <br>
                                                <input type="checkbox" name="privileges[]" id="testimonial" value="testimonial"> Testimonials <br>
                                                <input type="checkbox" name="privileges[]" id="store_gallery" value="store_gallery"> Store gallery <br>
                                            </div>
                                            <div>
                                                <h5>Category</h5>
                                                <input type="checkbox" name="privileges[]" id="categories" value="categories"> Categories <br>
                                                <input type="checkbox" name="privileges[]" id="scategories" value="scategories"> Sub Categories <br>
                                                <input type="checkbox" name="privileges[]" id="ccategories" value="ccategories"> Child Categories <br>
                                            </div>
                                            <div>
                                                <h5>Product</h5>
                                                <input type="checkbox" name="privileges[]" id="product" value="product"> Product <br>
                                                <input type="checkbox" name="privileges[]" id="orders" value="orders"> Orders <br>
                                                <input type="checkbox" name="privileges[]" id="tele_orders" value="tele_orders"> Offline Orders <br>
                                                <input type="checkbox" name="privileges[]" id="coupon" value="coupon"> Coupon <br>
                                                <input type="checkbox" name="privileges[]" id="notify" value="notify"> Notify <br>
                                                <input type="checkbox" name="privileges[]" id="newsletter" value="newsletter"> Newsletter <br>
                                            </div>
                                            <div>
                                                <h5>Report</h5>
                                                <input type="checkbox" name="privileges[]" id="order_report" value="order_report"> Orders Report<br>
                                                <input type="checkbox" name="privileges[]" id="stocks_report" value="stocks_report"> Stocks Report <br>
                                                <input type="checkbox" name="privileges[]" id="best_selling_products_report" value="best_selling_products_report"> Best Selling Products Report <br>
                                            </div>
                                        </div>
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
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <input type="submit" name="submit" id="save" class="btn btn-success"
                                            value="Create">
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
<script>
    $('#save').on('click', function() {
        if ($('#image').val() == '') {
            alert('Please Select Image');
        }
    });
    $('#image').on('change', function() {
        var numb = $(this)[0].files[0].size / 1024 / 1024;
        numb = numb.toFixed(2);
        if (numb > 2) {
            //            $('#image').val('');
            alert('too big, maximum is 2MB. Your file size is: ' + numb + ' MB');
            $(':input[type="submit"]').prop('disabled', true);
        } else {
            $(':input[type="submit"]').prop('disabled', false);
        }
    });
</script>
@endsection
