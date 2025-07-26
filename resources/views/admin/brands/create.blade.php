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
                                <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brands</a></li>
                                <li class="breadcrumb-item active">Add Brand</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Add Brand
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
                                    <h4 class="page-title">Add Brand</h4>
                                </div>
                            </div>
                            <hr>
                            <form id="form" method="post" action="{{ route('brands.store') }}"
                                  enctype="multipart/form-data">@csrf
<div class="form-group">
                                            <label for="brand">Brand * :</label>
                                            <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                                   name="brand" id="brand" value="{{ old('brand') }}"
                                                   autocomplete="off">
                                            @error('brand')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                <div class="form-group">
                                    <label for="image">Image * :</label>
                                    <input type="file" class="dropify @error('image') is-invalid @enderror" name="image"
                                           id="image" accept="image/jpg, image/jpeg, image/png">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
{{--                                    <span class="font-13 text-muted mt-2">* Image size: <code>width : 440px</code> x <code>height : 245px</code></span>--}}
                                </div>

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

                                        
                              

                                <div class="form-group mb-0">
                                    <input type="submit" name="submit" id="save" class="btn btn-success" value="Create">
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
    <script>
        $('#save').on('click', function () {
            if ($('#image').val() == '') {
                alert('Please Select Image');
            }
        });
        $('#image').on('change', function () {
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

