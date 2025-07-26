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
                                <li class="breadcrumb-item"><a href="{{ route('videoreviews.index') }}">Video Review</a></li>
                                <li class="breadcrumb-item active">Edit Video Review</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Edit Video Review
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
                                    <h4 class="page-title">Edit Video Review</h4>
                                </div>
                            </div>
                            <hr>
                            <form id="form" method="post" action="{{ route('videoreviews.update', $data->id) }}"
                                  enctype="multipart/form-data">@csrf @method('PUT')

                                <div class="form-group d-none">
                                    <label for="video">Video * :</label>
                                    <input type="file" class="dropify @error('video') is-invalid @enderror" name="video"
                                           id="video" accept="video/mp4,video/mkv" data-default-file="{{ asset('uploads/videos') . '/' . $data->video }}">
                                    @error('video')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <small>Dimension <code>1080 x 1920 pixels</code></small> <br>
                                    ↘ previous video <br>
                                    <video src="{{ asset('uploads/videos/' . $data->video) }}" class="img-fluid rounded mt-2" controls style="width: 20rem"></video> 
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="link">Link * :</label>
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

