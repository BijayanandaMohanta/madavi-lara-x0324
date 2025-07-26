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
                                <li class="breadcrumb-item"><a href="{{ route('product.index') }}"> Products</a></li>
                                <li class="breadcrumb-item active">Duplicate Product</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Duplicate Product
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
                                <h4 class="page-title">Duplicate Product</h4>
                            </div>
                        </div>
                        <hr>
                        <form id="form" method="post" action="{{ route('product.duplicate_store', [$data->id]) }}" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Product Name * :</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" value="{{ $data->name }}"
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
                                        <label for="category">Category * :</label>
                                        <select class="form-control @error('category_id') is-invalid @enderror"
                                            name="category_id" id="category_id">
                                            <option selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($category->id == $data->category_id) selected @endif>
                                                    {{ $category->category }}</option>
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
                                        <label for="gst">GST * :</label>
                                        <input type="number" class="form-control @error('gst') is-invalid @enderror"
                                            name="gst" id="gst" value="{{ $data->gst }}">
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
                                            name="mrp" id="mrp" value="{{ $data->mrp }}">
                                        @error('mrp')
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
                                        <input type="number"
                                            class="form-control @error('price') is-invalid @enderror" name="price"
                                            id="price" value="{{ $data->price }}">
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- stock --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stock">Stock * :</label>
                                        <input type="number"
                                            class="form-control @error('stock') is-invalid @enderror" name="stock"
                                            id="stock" value="{{ $data->stock }}">
                                        @error('stock')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="min_stock">Minimum Stock * :</label>
                                        <input type="number"
                                            class="form-control @error('min_stock') is-invalid @enderror" name="min_stock"
                                            id="min_stock" value="{{ $data->min_stock }}">
                                        @error('min_stock')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                               

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description * :</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                            id="description" rows="5" autocomplete="off">{{ $data->description }}</textarea>
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
                                        <label for="specification">Specification * :</label>
                                        <textarea class="form-control sun-editor @error('specification') is-invalid @enderror" name="specification"
                                            id="specification" rows="5" autocomplete="off">{{ $data->specification }}</textarea>
                                        @error('specification')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="highlights">Highlights * :</label>
                                        <textarea class="form-control sun-editor @error('highlights') is-invalid @enderror" name="highlights"
                                            id="highlights" rows="5" autocomplete="off">{{ $data->highlights }}</textarea>
                                        @error('highlights')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="form-group mb-0">
                                <input type="submit" name="submit" id="save" class="btn btn-success"
                                    value="Create Duplicate">
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
        if (this.files[0].size > 2000000) {
            alert("Please upload video less than 1MB. Thanks!!");
            $(this).val('');
        }
    });
</script> -->
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
