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
                                <li class="breadcrumb-item active">Add Categories</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Add Categories
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
                                    <h4 class="page-title">Add Categories</h4>
                                </div>
                            </div>
                            <hr>
                            <form id="form" method="post" action="{{ route('categories.store') }}"
                                  enctype="multipart/form-data">@csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Image * :</label>
                                            <input type="file" class="dropify @error('image') is-invalid @enderror" name="image"
                                                   id="image" accept="image/png">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <span class="font-13 text-muted">* Image size <code>width : 300px</code> x <code>height : 300px upload only .png image for best quality.</code> </span> <br>
                                            <kbd>This will display in the home page category slider</kbd>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="banner_image">Banner Image * :</label>
                                            <input type="file" class="dropify @error('banner_image') is-invalid @enderror" name="banner_image"
                                                   id="banner_image" accept="image/jpg, image/jpeg, image/png,image/webp">
                                            @error('banner_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <span class="font-13 text-muted">* Image size <code>1418 × 396 pixels</code></span> <br>
                                            <kbd>Display in the view page of category listing.</kbd>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="homepage_side">Home Page Side Image * :</label>
                                            <input type="file" class="dropify @error('homepage_side') is-invalid @enderror" name="homepage_side"
                                                   id="homepage_side" accept="image/jpg, image/jpeg, image/png,image/webp">
                                            @error('homepage_side')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <span class="font-13 text-muted">* Image size <code> 300 × 359 pixels</code></span> <br>
                                            <kbd>First image in the home page product category wise display</kbd>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="homepage_side_mobile">Home Page Side Image (Mobile view) * :</label>
                                            <input type="file" class="dropify @error('homepage_side_mobile') is-invalid @enderror" name="homepage_side_mobile"
                                                   id="homepage_side_mobile" accept="image/jpg, image/jpeg, image/png,image/webp">
                                            @error('homepage_side_mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <span class="font-13 text-muted">* Image size <code> 295 x 150 pixels</code></span> <br>
                                            <kbd>First image in the home page product category wise display in mobile view</kbd>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="category">Category * :</label>
                                            <input type="text" class="form-control @error('category') is-invalid @enderror"
                                                   name="category" id="category" value="{{ old('category') }}"
                                                   autocomplete="off">
                                            @error('category')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status * :</label>
                                            <select class="form-control @error('status') is-invalid @enderror" name="status"
                                                    id="status">
                                                <option value="1" selected>Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="display_menu">Display in Menu * :</label>
                                            <select class="form-control @error('display_menu') is-invalid @enderror" name="display_menu"
                                                    id="display_menu">
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            @error('display_menu')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="display_home">Display in Home * :</label>
                                            <select class="form-control @error('display_home') is-invalid @enderror" name="display_home"
                                                    id="display_home">
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            @error('display_home')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="priority">Priority * :</label>
                                            @if ($availablePriorities)
                                                <select name="priority" id="priority" class="form-control">
                                                    @foreach($availablePriorities as $priority)
                                                        <option value="{{ $priority }}">{{ $priority }}</option>
                                                    @endforeach
                                                </select>
                                            
                                            
                                            @else
                                                <p>Not possible to add in the priority list</p>
                                            @endif
                                            @error('priority')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    

                                </div>

                                <div class="form-group mb-0">
                                    <input type="submit" name="submit" id="save" class="btn btn-success" value="Create">
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
    <script>
        $('#display_menu').on('change', function() {
            if ($(this).val() == 0) {
                $('#priority').val(0); // set priority to 0
                $('#priority').prop('disabled', true); // disable priority select
            } else {
                $('#priority').prop('disabled', false); // enable priority select
            }
        });
        // Check initial value of display_menu and set priority accordingly
        if ($('#display_menu').val() == 0) {
            $('#priority').val(0); // set priority to 0
            $('#priority').prop('disabled', true); // disable priority select
        }
    </script>
@endsection

