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
                                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                                <li class="breadcrumb-item active">Edit Ad</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Ad
                    @endsection
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @include('flash_msg')
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="page-title">Ad</h4>
                            </div>
                        </div>
                        <hr>
                        <form id="form" method="post" action="{{ route('categories.ad_update', [$data->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-1">

                                <input type="hidden" name="category_id" value="{{$data->category_id}}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">Image * :</label>
                                        <input type="file"
                                            class="dropify @error('image') is-invalid @enderror"
                                            name="image" id="image"
                                            accept="image/jpg, image/jpeg, image/png, image/webp" data-default-file="{{ asset('uploads') }}/ads/{{ $data->image }}">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <kbd>Image size 804 × 1044 pixels</kbd>
                                        {{-- <a href="{{ asset('uploads') }}/ads/{{ $data->thumbnail_image }}" target="_blank"> → view image</a> --}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="priority">Priority * :</label>
                                        <input type="text" class="form-control @error('priority') is-invalid @enderror"
                                               name="priority" id="priority" value="{{ $data->priority }}"
                                               autocomplete="off">
                                        @error('priority')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="redirect_link">Redirect link * :</label>
                                        <input type="text" class="form-control @error('redirect_link') is-invalid @enderror"
                                               name="redirect_link" id="redirect_link" value="{{ $data->redirect_link }}"
                                               autocomplete="off">
                                        @error('redirect_link')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            
                            </div>

                            <div class="form-group mb-0">
                                <input type="submit" name="submit" id="save" class="btn btn-success"
                                    value="Update">
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
