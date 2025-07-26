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
                                <li class="breadcrumb-item"><a href="{{ route('seo-settings.index') }}">SEO Settings</a></li>
                                <li class="breadcrumb-item active">Edit SEO Page</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Edit SEO Page
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
                                    <h4 class="page-title">Edit SEO Page</h4>
                                </div>
                            </div>
                            <hr>
                            <form id="form" method="post" action="{{ route('seo-settings.update', $data->id) }}"
                                  enctype="multipart/form-data">@csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="fullname">Page Name * :</label>
                                    <input type="text" class="form-control @error('page_name') is-invalid @enderror"
                                           name="page_name" id="page_name" value="{{ $data->page_name }}"
                                           autocomplete="off">
                                    @error('page_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="fullname">Title * :</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           name="title" id="title" value="{{ $data->title }}"
                                           autocomplete="off">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="fullname">Keywords * :</label>
                                    <input type="text" class="form-control @error('keywords') is-invalid @enderror"
                                           name="keywords" id="keywords" value="{{ $data->keywords }}"
                                           autocomplete="off" data-role="tagsinput">
                                    @error('keywords')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                    <span class="font-13 text-muted pt-2">After typing one keyword please press <kbd>Enter</kbd> Key</span>
                                </div>

                                <div class="form-group">
                                    <label for="fullname">Description * :</label>
                                    <textarea name="description" id="description" class="form-control">{{ $data->description }}</textarea>
                                    @error('description')
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
    <link href="{{ asset('admin_assets') . '/libs/bootstrap-tagsinput/bootstrap-tagsinput.css' }}" rel="stylesheet" />
@endsection
@section('jscodes')
    <script src="{{ asset('admin_assets') . '/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js' }}"></script>
    <script src="{{ asset('admin_assets') . '/js/pages/form-advanced.init.js' }}"></script>
@endsection

