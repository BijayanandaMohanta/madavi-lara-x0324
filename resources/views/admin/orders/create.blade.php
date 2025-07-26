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
                                <li class="breadcrumb-item"><a href="{{ route('tests.index') }}">Tests</a></li>
                                <li class="breadcrumb-item active">Add Test</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Add Test
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
                                    <h4 class="page-title">Add Test</h4>
                                </div>
                            </div>
                            <hr>
                            <form id="form" method="post" action="{{ route('tests.store') }}"
                                  enctype="multipart/form-data">@csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category">Category * :</label>
                                            <select class="form-control @error('category_id') is-invalid @enderror" name="category"
                                                    id="category">
                                                <option selected disabled>Select Category</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Test Name * :</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   name="name" id="name" value="{{ old('name') }}"
                                                   autocomplete="off">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Test Code * :</label>
                                            <input type="text" class="form-control @error('test_code') is-invalid @enderror"
                                                   name="test_code" id="test_code" value="{{ old('test_code') }}"
                                                   autocomplete="off">
                                            @error('test_code')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Color Code * :</label>
                                            <input type="text" class="form-control @error('color_code') is-invalid @enderror"
                                                   name="color_code" id="color_code" value="{{ old('color_code') }}"
                                                   autocomplete="off">
                                            @error('color_code')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                     <div class="form-group">
                                <label for="fullname">Is It Popular Test* :</label>
                                <select class="form-control @error('is_it_popular') is-invalid @enderror" name="is_it_popular" id="is_it_popular" >
                                    <option value="">Choose</option>

                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>

                                </select>
                                @error('is_it_popular')
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
                                                   id="image" accept="image/jpg, image/jpeg, image/png">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <span class="font-13 text-muted">* Image size <code>width : 200px</code> x <code>height : 200px</code></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Mrp * :</label>
                                            <input type="text" class="form-control @error('mrp') is-invalid @enderror"
                                                   name="mrp" id="mrp" value="{{ old('mrp') }}"
                                                   autocomplete="off">
                                            @error('mrp')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Price * :</label>
                                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                                   name="price" id="price" value="{{ old('price') }}"
                                                   autocomplete="off">
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Specimen * :</label>
                                            <input type="text" class="form-control @error('specimen') is-invalid @enderror"
                                                   name="specimen" id="specimen" value="{{ old('specimen') }}"
                                                   autocomplete="off">
                                            @error('specimen')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Parameter * :</label>
                                            <input type="text" class="form-control @error('parameter') is-invalid @enderror"
                                                   name="parameter" id="parameter" value="{{ old('parameter') }}"
                                                   autocomplete="off">
                                            @error('parameter')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Result * :</label>
                                            <input type="text" class="form-control @error('result') is-invalid @enderror"
                                                   name="result" id="result" value="{{ old('result') }}"
                                                   autocomplete="off">
                                            @error('result')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Unit * :</label>
                                            <input type="text" class="form-control @error('unit') is-invalid @enderror"
                                                   name="unit" id="unit" value="{{ old('unit') }}"
                                                   autocomplete="off">
                                            @error('unit')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Comments * :</label>
                                            <textarea id="summernote-editor" class="form-control" name="comments"></textarea>
                                            @error('comments')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Refference Range * :</label>
                                            <textarea id="summernote-editor1" class="form-control" name="reference_range"></textarea>
                                            @error('reference_range')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Min Range * :</label>
                                            <input type="text" class="form-control @error('min_range') is-invalid @enderror"
                                                   name="min_range" id="min_range" value="{{ old('min_range') }}"
                                                   autocomplete="off">
                                            @error('min_range')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Max Range * :</label>
                                            <input type="text" class="form-control @error('max_range') is-invalid @enderror"
                                                   name="max_range" id="max_range" value="{{ old('max_range') }}"
                                                   autocomplete="off">
                                            @error('max_range')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Reporting Heading * :</label>
                                            <input type="text" class="form-control @error('reporting_heading') is-invalid @enderror"
                                                   name="reporting_heading" id="reporting_heading" value="{{ old('reporting_heading') }}"
                                                   autocomplete="off">
                                            @error('reporting_heading')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Turn Around Time * :</label>
                                            <input type="text" class="form-control @error('reporting_date_time') is-invalid @enderror"
                                                   name="turn_around_time" id="turn_around_time" value="{{ old('turn_around_time') }}"
                                                   autocomplete="off">
                                            @error('turn_around_time')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Individual Method * :</label>
                                            <textarea id="summernote-editor1" class="form-control" name="individual_method"></textarea>
                                            @error('individual_method')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Method * :</label>
                                            <textarea id="summernote-editor1" class="form-control" name="method"></textarea>
                                            @error('method')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Disable Formulla * :</label>
                                            <textarea id="summernote-editor1" class="form-control" name="disable_formulla"></textarea>
                                            @error('disable_formulla')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Test Report Below Range Comment * :</label>
                                            <textarea id="summernote-editor1" class="form-control" name="below_range_comment"></textarea>
                                            @error('below_range_comment')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Test Report Above Range Comment * :</label>
                                            <textarea id="summernote-editor1" class="form-control" name="above_range_comment"></textarea>
                                            @error('above_range_comment')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                     <div class="form-group">
                                <label for="fullname">Status * :</label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" >
                                    <option value="">Choose Status</option>

                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>

                                </select>
                                @error('status')
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
    <!-- <script>
        $('#intro_video').on('change', function() {
            if(this.files[0].size > 2000000) {
                alert("Please upload video less than 1MB. Thanks!!");
                $(this).val('');
            }
        });
    </script> -->

@endsection
