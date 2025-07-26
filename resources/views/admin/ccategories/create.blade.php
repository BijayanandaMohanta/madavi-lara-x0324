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
                                <li class="breadcrumb-item"><a href="{{ route('scategories.index') }}">Child Category</a></li>
                                <li class="breadcrumb-item active">Add Child Category</li>
                            </ol>
                        </div>
                    @section('page_title')
                       Add Child Category
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
                                <h4 class="page-title">Add Child Category</h4>
                            </div>
                        </div>
                        <hr>
                        <form id="form" method="post" action="{{ route('ccategories.store') }}"
                            enctype="multipart/form-data">@csrf

                            <div class="row">


                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id">Category * :</label>
                                            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id"
                                                    id="category_id">
                                                <option selected disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                </div>                                
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Sub Category  * :</label>

                                            <select class="form-control @error('sub_category_id') is-invalid @enderror" name="sub_category_id"
                                                    id="sub_category_id">
                                                    </select>
                                    @error('sub_category_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="category">Child Category Name * :</label>
                                            <input type="text" class="form-control @error('category') is-invalid @enderror"
                                                   name="category" id="category" value="{{ old('category') }}"
                                                   autocomplete="off">
                                            @error('category')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>



                                <div class="col-md-12 d-none">
                                    <div class="form-group">
                                        <label for="image">Image * :</label>
                                        <input type="file" class="dropify @error('image') is-invalid @enderror"
                                            name="image" id="image" accept="image/jpg, image/jpeg, image/png">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="font-13 text-muted">* Image size <code>width : 200px</code> x
                                            <code>height : 200px</code></span>
                                    </div>
                                </div>
                               

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fullname">Status * :</label>
                                        <select class="form-control @error('status') is-invalid @enderror"
                                            name="status" id="status">
                                            <option value="">Choose Status</option>

                                            <option value="1">Active</option>
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
<!-- <script>
    $('#intro_video').on('change', function() {
        if (this.files[0].size > 2000000) {
            alert("Please upload video less than 1MB. Thanks!!");
            $(this).val('');
        }
    });
</script> -->
@endsection


