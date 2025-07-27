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
                                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product</a></li>
                                <li class="breadcrumb-item active">Add Product</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Add Product
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
                                <h4 class="page-title">Add Product</h4>
                            </div>
                        </div>
                        <hr>
                        <form id="form" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product Name * :</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" value="{{ old('name') }}" autocomplete="off">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Category * :</label>
                                        <select class="form-control @error('category_id') is-invalid @enderror"
                                            name="category_id" id="category_id">
                                            <option selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description * :</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                            name="description" id="description" rows="5"
                                            autocomplete="off">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- specification need text editor --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="specification">Product Details * :</label>
                                        <textarea class="form-control sun-editor @error('specification') is-invalid @enderror"
                                            name="specification" id="specification" rows="5"
                                            autocomplete="off">{{ old('specification') }}</textarea>
                                        @error('specification')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="highlights">Additional Information * :</label>
                                        <textarea class="form-control sun-editor @error('highlights') is-invalid @enderror"
                                            name="highlights" id="highlights" rows="5"
                                            autocomplete="off">{{ old('highlights') }}</textarea>
                                        @error('highlights')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="size_chart_image">Product Detail Image * :</label>
                                        <input type="file" class="dropify @error('size_chart_image') is-invalid @enderror"
                                            name="size_chart_image" id="size_chart_image" accept="image/jpg, image/jpeg, image/png">
                                        @error('size_chart_image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <kbd>Image size 900 x 450px</kbd>
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
                            </div>

                            <div class="form-group mb-0">
                                <input type="submit" name="submit" id="save" class="btn btn-success"
                                    value="Create">
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet" />

{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.js"></script>


<script>
    $(".select2").select2();

    $(".select2").on("select2:select", function(evt) {
        var element = evt.params.data.element;
        var $element = $(element);

        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });
</script>
@endsection
