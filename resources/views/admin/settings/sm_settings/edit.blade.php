@extends('admin.layouts.main')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Social Media Settings</li>
                    </ol>
                </div>
                @section('page_title')
                    Social Media Settings
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
                    <h4 class="page-title">Social Media Settings</h4>
                    <hr>
                    <form action="{{ route('social-media-settings.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="facebook" class="control-label">Facebook *</label>
                                        <input type="text" class="form-control @error('facebook') is-invalid @enderror"
                                               id="facebook" name="facebook" autocomplete="off"
                                               value="{{ $data->facebook }}">
                                        @error('facebook')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="instagram" class="control-label">Instagram *</label>
                                        <input type="text" class="form-control @error('instagram') is-invalid @enderror"
                                               id="instagram" name="instagram" autocomplete="off"
                                               value="{{ $data->instagram }}">
                                        @error('instagram')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="linkedin" class="control-label">Telegram *</label>
                                        <input type="text" class="form-control @error('linkedin') is-invalid @enderror"
                                               id="linkedin" name="linkedin" autocomplete="off"
                                               value="{{ $data->linkedin }}">
                                        @error('linkedin')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="twitter" class="control-label">Whatsapp *</label>
                                        <input type="text" class="form-control @error('twitter') is-invalid @enderror"
                                               id="twitter" name="twitter" autocomplete="off"
                                               value="{{ $data->twitter }}">
                                        @error('twitter')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="youtube" class="control-label">Youtube *</label>
                                        <input type="text" class="form-control @error('youtube') is-invalid @enderror"
                                               id="youtube" name="youtube" autocomplete="off"
                                               value="{{ $data->youtube }}">
                                        @error('youtube')
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

@endsection
