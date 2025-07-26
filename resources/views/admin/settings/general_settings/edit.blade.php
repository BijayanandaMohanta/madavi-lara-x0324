@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Site Settings</li>
                    </ol>
                </div>
                @section('page_title')
                    Site Settings
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
                    <h4 class="page-title">Site Settings</h4>
                    <hr>
                    <form action="{{ route('site-settings.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="welcome_message" class="control-label">Welcome Message *</label>
                                        <textarea class="form-control autogrow @error('welcome_message') is-invalid @enderror"
                                                  id="welcome_message" name="welcome_message"
                                                  style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">{{ $data->welcome_message }}</textarea>
                                        @error('welcome_message')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="offer_message" class="control-label">Offer message*</label>
                                        <input type="text" class="form-control @error('offer_message') is-invalid @enderror"
                                               id="offer_message" name="offer_message" autocomplete="off"
                                               value="{{ $data->offer_message }}">
                                        @error('offer_message')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="offer_link" class="control-label">Offer link*</label>
                                        <input type="text" class="form-control @error('offer_link') is-invalid @enderror"
                                               id="offer_link" name="offer_link" autocomplete="off"
                                               value="{{ $data->offer_link }}">
                                        @error('offer_link')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="site_name" class="control-label">Site Name *</label>
                                        <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                                               id="site_name" name="site_name" autocomplete="off"
                                               value="{{ $data->site_name }}">
                                        @error('site_name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group no-margin">
                                        <label for="address" class="control-label">Office Address *</label>
                                        <textarea class="form-control autogrow @error('address') is-invalid @enderror"
                                                  id="address" name="address"
                                                  style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">{{ $data->address }}</textarea>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group no-margin">
                                        <label for="store_address" class="control-label">Store Address *</label>
                                        <textarea class="form-control autogrow @error('store_address') is-invalid @enderror"
                                                  id="store_address" name="store_address"
                                                  style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">{{ $data->store_address }}</textarea>
                                        @error('store_address')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="retail_number" class="control-label">Retail number *</label>
                                        <input type="text" class="form-control @error('retail_number') is-invalid @enderror"
                                               id="retail_number" name="retail_number" autocomplete="off" value="{{ $data->retail_number }}">
                                        @error('retail_number')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="wholesale_number" class="control-label">Wholesale number *</label>
                                        <input type="text" class="form-control @error('wholesale_number') is-invalid @enderror"
                                               id="wholesale_number" name="wholesale_number" autocomplete="off" value="{{ $data->wholesale_number }}">
                                        @error('wholesale_number')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" autocomplete="off" value="{{ $data->email }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile_number" class="control-label">Mobile number *</label>
                                        <input type="text" class="form-control @error('mobile_number') is-invalid @enderror"
                                               id="mobile_number" name="mobile_number" autocomplete="off" value="{{ $data->mobile_number }}">
                                        @error('mobile_number')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="toll_free_number" class="control-label">Toll free number *</label>
                                        <input type="text" class="form-control @error('toll_free_number') is-invalid @enderror"
                                               id="toll_free_number" name="toll_free_number" autocomplete="off" value="{{ $data->toll_free_number }}">
                                        @error('toll_free_number')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="aware_message" class="control-label">Beware Message footer *</label>
                                        <textarea class="form-control autogrow @error('aware_message') is-invalid @enderror"
                                                  id="aware_message" name="aware_message"
                                                  style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">{{ $data->aware_message }}</textarea>
                                        @error('aware_message')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo" class="control-label">Logo *</label>
                                        <input type="file" id="logo"
                                               class="dropify @error('logo') is-invalid @enderror" name="logo"
                                               data-height="150" data-default-file="{{ asset('site_settings') . '/' . $data->logo }}"/>
                                        @error('logo')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="footer_logo" class="control-label">Footer Logo *</label>
                                        <input type="file" id="footer_logo"
                                               class="dropify @error('footer_logo') is-invalid @enderror" name="footer_logo"
                                               data-height="150" data-default-file="{{ asset('site_settings') . '/' . $data->footer_logo }}"/>
                                        @error('footer_logo')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="favicon" class="control-label">Favicon *</label>
                                        <input type="file" id="favicon"
                                               class="dropify @error('favicon') is-invalid @enderror" name="favicon"
                                               data-height="150" data-default-file="{{ asset('site_settings') . '/' . $data->favicon }}"/>
                                        @error('favicon')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="login_image" class="control-label">Login time image *</label>
                                        <input type="file" id="login_image"
                                               class="dropify @error('login_image') is-invalid @enderror" name="login_image"
                                               data-height="150" data-default-file="{{ asset('site_settings') . '/' . $data->login_image }}"/>
                                        @error('login_image')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small>Recommended size 900px X 892px</small>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="map_iframe" class="control-label">Map iframe code *</label>
                                        <textarea class="form-control autogrow @error('map_iframe') is-invalid @enderror"
                                                  id="map_iframe" name="map_iframe"
                                                  style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">{{ $data->map_iframe }}</textarea>
                                        @error('map_iframe')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="google_map_link" class="control-label">Map link *</label>
                                        <input type="text" class="form-control @error('google_map_link') is-invalid @enderror"
                                               id="google_map_link" name="google_map_link" autocomplete="off" value="{{ $data->google_map_link }}">
                                        @error('google_map_link')
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
