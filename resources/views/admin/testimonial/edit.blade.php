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
                                <li class="breadcrumb-item"><a href="{{ route('testimonial.index') }}">Testimonial</a></li>
                                <li class="breadcrumb-item active">Edit Testimonial</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Testimonial
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
                                    <h4 class="page-title">Testimonial</h4>
                                </div>
                            </div>
                            <hr>
                            <form id="form" method="post" action="{{ route('testimonial.update', [$data->id]) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">

                                  
    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="control-label">Name *</label>
                                            <input type="text" id="name"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ $data->name }}" />
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="designation">Designation  * :</label>
                                            <input type="text" class="form-control @error('designation') is-invalid @enderror"
                                                   name="designation" id="designation"                                                   autocomplete="off" value="{{ $data->designation }}">
                                            @error('designation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                   

                                    <div class="col-md-12">
                                        <div class="form-group no-margin">
                                            <label for="review" class="control-label">Review*</label>
                                            <textarea class="form-control autogrow @error('review') is-invalid @enderror" id="review" name="review"
                                                style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">{{ $data->review }}</textarea>
                                            @error('review')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="profile_image">Profile Image * :</label>
                                            <input type="file" class="dropify @error('profile_image') is-invalid @enderror" name="profile_image"
                                                   id="profile_image" accept="image/jpg, image/jpeg, image/png,image/webp" data-default-file="{{ asset('uploads/testimonial/'.$data->profile_image) }}">
                                            @error('profile_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <span class="font-13 text-muted">* Image size <code>width : 170px</code> x <code>height : 170px</code></span>
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
