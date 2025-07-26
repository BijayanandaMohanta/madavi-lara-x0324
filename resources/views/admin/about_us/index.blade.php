@extends('admin.layouts.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">About Us</li>
                    </ol>
                </div>
                @section('page_title')
                    About Us 
                @endsection
            </div>
        </div>
        <!-- end page title -->
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @include('flash_msg')
                    <h4 class="page-title">About Us</h4>
                    <hr>
                    <form action="{{ route('about_us.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="about_us_image" class="control-label">About Us Image *</label>
                                        <input type="file" id="about_us_image"
                                               class="dropify @error('about_us_image') is-invalid @enderror" name="about_us_image" accept="image/jpg, image/jpeg, image/png,image/webp"
                                               data-height="150" data-default-file="{{ asset('uploads') }}/{{ $data->about_us_image }}"/>
                                        @error('about_us_image')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <span class="font-13 text-muted mt-2">* Image size: <code>width : 600px</code> X <code>height : 602px</code></span>
                                    </div>
                                </div>

                               

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_1" class="control-label">Title  *</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                               id="title" name="title" autocomplete="off"
                                               value="{{ $data->title }}">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_2" class="control-label">Designation *</label>
                                        <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                               id="designation" name="designation" autocomplete="off"
                                               value="{{ $data->designation }}">
                                        @error('designation')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group no-margin">
                                        <label for="about_us_description" class="control-label">About Us Description *</label>
                                        <textarea class="form-control autogrow @error('about_us_description') is-invalid @enderror"
                                                  id="about_us_description" name="about_us_description"
                                                  style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">{{ $data->about_us_description }}</textarea>
                                        @error('about_us_description')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                               
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('csscodes')
    <link rel="stylesheet" href="{{ asset('admin_assets') . '/libs/dropify/dropify.min.css' }}">
@endsection
@section('jscodes')
    <!-- Plugins js -->
    <script src="{{ asset('admin_assets') . '/libs/dropify/dropify.min.js' }}"></script>

    <!-- Init js-->
    <script src="{{ asset('admin_assets') . '/js/pages/form-fileuploads.init.js' }}"></script>

    <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>

    <script>

        setTimeout(function () {
            const editors = document.getElementsByClassName("ckeditor-desc");
            for (let i = 0; i < editors.length; i++) {
                CKEDITOR.replace(editors[i]);
            }
        }, 50);
    </script>

@endsection
