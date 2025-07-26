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
                                <li class="breadcrumb-item active">Edit Brand</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Edit Brand
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
                                    <h4 class="page-title">Edit Brand</h4>
                                </div>
                            </div>
                            <hr>
                            <form id="form" method="post" action="{{ route('brands.update', $data->id) }}"
                                  enctype="multipart/form-data">@csrf @method('PUT')
<div class="form-group">
                                            <label for="brand">Brand * :</label>
                                            <input type="text" class="form-control @error('brand') is-invalid @enderror"
                                                   name="brand" id="brand" value="{{ $data->brand }}"
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
                                           id="image" accept="image/jpg, image/jpeg, image/png" data-default-file="{{ asset('uploads/brand') . '/' . $data->image }}">
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
                                        <option value="1" @if($data->status == 1) selected @endif>Active</option>
                                        <option value="0" @if($data->status == 0) selected @endif>Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-0">
                                    <input type="submit" name="submit" id="save" class="btn btn-success" value="Update">
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

