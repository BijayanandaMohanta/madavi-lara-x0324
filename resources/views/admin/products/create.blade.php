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

                                <div class="col-md-12">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Sub Category * :</label>

                                        <select class="form-control @error('sub_category_id') is-invalid @enderror"
                                            name="sub_category_id" id="sub_category_id">
                                            <option value="">Select Sub Category</option>
                                        </select>
                                        @error('sub_category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="child_category_id">Child Category * :</label>

                                        <select class="form-control @error('child_category_id') is-invalid @enderror"
                                            name="child_category_id" id="child_category_id">
                                            <option value="">Select Child Category</option>
                                        </select>
                                        @error('child_category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Brand choose --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="brand">Brand * :</label>
                                        <select class="form-control @error('brand') is-invalid @enderror"
                                            name="brand" id="brand">
                                            <option selected disabled>Select Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->brand }}">{{ $brand->brand }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- gst input allow only number --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gst">GST * :</label>
                                        <input type="number" class="form-control @error('gst') is-invalid @enderror"
                                            name="gst" id="gst" value="{{ old('gst') }}">
                                        @error('gst')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- mrp --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mrp">MRP * :</label>
                                        <input type="number" class="form-control @error('mrp') is-invalid @enderror"
                                            name="mrp" id="mrp" value="{{ old('mrp') }}">
                                        @error('mrp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- mop --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mop">MOP * :</label>
                                        <input type="number" class="form-control @error('mop') is-invalid @enderror"
                                            name="mop" id="mop" value="{{ old('mop') }}">
                                        @error('mop')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- price --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price">Price * :</label>
                                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                                            name="price" id="price" value="{{ old('price') }}">
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- stock --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="stock">Stock * :</label>
                                        <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                            name="stock" id="stock" value="{{ old('stock') }}">
                                        @error('stock')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="min_stock">Minimum Stock * :</label>
                                        <input type="number" class="form-control @error('min_stock') is-invalid @enderror"
                                            name="min_stock" id="min_stock" value="{{ old('min_stock') }}">
                                        @error('min_stock')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="out_of_stock">Out of stock Display * :</label>
                                        <select class="form-control @error('out_of_stock') is-invalid @enderror" name="out_of_stock"
                                                id="out_of_stock">
                                            <option value="Yes" selected>Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        @error('out_of_stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tags">Tags * :</label>
                                        <select class="form-control select2 @error('tags') is-invalid @enderror"
                                            name="tags[]" id="tags" multiple>
                                            <option value="" disabled>Select Tags</option>
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                                    {!! $tag->tag !!}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('tags')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                               
                                <style>
                                    .select2-selection__choice {
                                        background-color: #1f1f1f !important;
                                    }
                                </style>
                                <script>
                                    jQuery(document).ready(function($) {
                                        $('.select2').select2();
                                    });
                                </script>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description * :</label>
                                        <textarea class="form-control sun-editor @error('description') is-invalid @enderror"
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="specification">Specification * :</label>
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
                                        <label for="warranty">Warranty * :</label>
                                        <textarea class="form-control sun-editor @error('warranty') is-invalid @enderror"
                                            name="warranty" id="warranty" rows="5"
                                            autocomplete="off">
                                            <ul>
                                              <li>6-8 months warranty</li>
                                              <li>Multiple QC passed before shipping</li>
                                              <li>Sourced from legal channels</li>
                                              <li>Original products only or money back guarantee</li>
                                              <li>With GST Bill​</li>
                                              <li>Delivery in 5 to 7 Working Days</li>
                                            </ul>
                                            </textarea>
                                        @error('warranty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="highlights">Highlights * :</label>
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
                                

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="size_chart_image">Size chart image 1 * :</label>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="size_chart_image2">Size chart image 2 * :</label>
                                        <input type="file" class="dropify @error('size_chart_image2') is-invalid @enderror"
                                            name="size_chart_image2" id="size_chart_image2" accept="image/jpg, image/jpeg, image/png">
                                        @error('size_chart_image2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <kbd>Image size 900 x 450px</kbd>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="size_chart_image3">Size chart image 3 * :</label>
                                        <input type="file" class="dropify @error('size_chart_image3') is-invalid @enderror"
                                            name="size_chart_image3" id="size_chart_image3" accept="image/jpg, image/jpeg, image/png">
                                        @error('size_chart_image3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <kbd>Image size 900 x 450px</kbd>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="youtube_thumbnail">Youtube Thumbnail Image* :</label>
                                        <input type="file" class="dropify @error('youtube_thumbnail') is-invalid @enderror"
                                            name="youtube_thumbnail" id="youtube_thumbnail" accept="image/jpg, image/jpeg, image/png">
                                        @error('youtube_thumbnail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <kbd>Image size 500 x 500px</kbd>
                                    </div>
                                </div>

                                {{-- youtube_video --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="youtube_video">Youtube Video * :</label>
                                        <input type="text" class="form-control @error('youtube_video') is-invalid @enderror"
                                            name="youtube_video" id="youtube_video" value="{{ old('youtube_video') }}">
                                        @error('youtube_video')
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
