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
                            <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">CMS Pages</a></li>
                            <li class="breadcrumb-item active">Update {{ $page->name }}</li>
                        </ol>
                    </div>
                    @section('page_title')
                    Update {{ $page->name }}
                    @endsection
                    <h4 class="page-title">Update {{ $page->name }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->





        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">


                        <form id="form"  method="post" action="{{ route('pages.update', [$page->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="url" value="{{URL::previous()}}">
                            <div class="form-group">
                                <label for="description">Description * :</label>
                                <textarea class="form-control sun-editor" name="description" required>{{ old('description', $page->description ?? null) }}</textarea>
                                @error('description')
                                <div class="alert alert-danger bg-transparent text-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            @if($page->id == 1)
                            <div class="form-group">
                                <label for="fullname">Image :</label>
                                <input type="file" class="dropify" name="image" id="image" accept="image/*" @if(isset($page->image)) data-default-file="{{url('uploads')}}/{{ $page->image }}" @endif >

                            </div>
                            <div class="form-group">
                                <label for="description">Description 2 :</label>
                                <textarea class="form-control sun-editor" name="description2">{{ old('description2', $page->description2 ?? null) }}</textarea>

                            </div>
                            @endif
                            @if($page->id == 4)
                            <div class="form-group">
                                <label for="fullname">Image :</label>
                                <input type="file" class="dropify" name="image" id="image" accept="image/*" @if(isset($page->image)) data-default-file="{{ asset('uploads/')}}/{{ $page->image }}" @endif >

                            </div>

                            @endif

                            <div class="form-group mb-0">
                                <input type="submit" name="submit" class="btn btn-success" value="Update {{ $page->name }}">
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

@section('jscode')
<script>
$(document).ready(function() {
    $("#summernote-editor2").summernote({ height: 350, minHeight: null, maxHeight: null, focus: !1 })
});
</script>
@endsection