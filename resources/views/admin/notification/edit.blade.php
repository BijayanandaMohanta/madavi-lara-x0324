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
                                <li class="breadcrumb-item"><a href="{{ route('amazing_apps.index') }}">Amazing Apps</a></li>
                                <li class="breadcrumb-item active">Edit Amazing Apps</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Edit Amazing Apps
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
                                    <h4 class="page-title">Edit Amazing Apps</h4>
                                </div>
                            </div>
                            <hr>
                            <form id="form" method="post" action="{{ route('amazing_apps.update', $data->id) }}"
                                  enctype="multipart/form-data">@csrf @method('PUT')

                                <div class="row">
                                   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Title * :</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                   name="title" id="title" value="{{ $data->title }}"
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
                                            <label for="image">Image * :</label>
                                            <input type="file" class="dropify @error('image') is-invalid @enderror" name="image"
                                                   id="image" accept="image/jpg, image/jpeg, image/png,image/webp" data-default-file="{{ asset('uploads/amazing_apps/') }}/{{ $data->image }}">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <span class="font-13 text-muted">* Image size <code>width : 1920px</code> x <code>height : 830px</code></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Description * :</label>
                                            <textarea  class="form-control" value="{{ $data->description }}" name="description">{{ $data->description }}</textarea>
                                            @error('description')
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
    <script>
       
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


