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
                                <li class="breadcrumb-item active">Edit Ad</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Ads
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
                                    <h4 class="page-title">Ads</h4>
                                </div>
                            </div>
                            <hr>
                            <form id="form" method="post" action="{{ route('ads.update', [$data->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="image">Image * :</label>
                                            <input type="file" class="dropify @error('image') is-invalid @enderror" name="image"
                                                   id="image" accept="image/jpg, image/jpeg, image/png" data-default-file="{{ asset('uploads/ads') }}/{{ $data->image }}">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <span class="font-13 text-muted">* Image size <code>Ad 1 : 1418 x 396 pixels, Ad 2 : 519 x 300 pixels</code></span>
                                        </div>
                                    </div>

                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullname">Type * :</label>
                                            <select class="form-control @error('type') is-invalid @enderror" name="type"
                                                    id="type">
                                                <option value="Home Ad1" @if($data->type == 'Home Ad1') selected @endif>Home Ad1</option>
                                                <option value="Home Ad2" @if($data->type == 'Home Ad2') selected @endif>Home Ad2</option>
                                                
                                            </select>
                                            @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link">Link  :</label>
                                            <input type="text" class="form-control @error('link') is-invalid @enderror"
                                                   name="link" id="link" value="{{ $data->link }}"
                                                   autocomplete="off">
                                            @error('link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
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
