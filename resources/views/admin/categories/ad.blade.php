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
                                <li class="breadcrumb-item active">Ads</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Ads
                    @endsection
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        @include('flash_msg')
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('categories.index')}}" class="btn btn-dark btn-sm float-right">← All Categories</a>
                                <h4 class="page-title">Ads</h4>

                                <form action="{{ route('categories.ad_store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">


                                            <input type="hidden" name="category_id" value="{{ $id }}">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="image">Image * :</label>
                                                    <input type="file"
                                                        class="dropify @error('image') is-invalid @enderror"
                                                        name="image" id="image"
                                                        accept="image/jpg, image/jpeg, image/png, image/webp">
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <kbd>Image size 804 × 1044 pixels</kbd>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="priority">Priority * :</label>
                                                    <input type="text" class="form-control @error('priority') is-invalid @enderror"
                                                           name="priority" id="priority" value="{{ old('priority') }}"
                                                           autocomplete="off">
                                                    @error('priority')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="redirect_link">Redirect link * :</label>
                                                    <input type="text" class="form-control @error('redirect_link') is-invalid @enderror"
                                                           name="redirect_link" id="redirect_link" value="{{ old('redirect_link') }}"
                                                           autocomplete="off">
                                                    @error('redirect_link')
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-success waves-effect waves-light">Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>image</th>
                                        <th>Modified At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if ($data->image != '')
                                                    <a href="{{ asset('uploads') }}/ads/{{ $data->image }}"
                                                        target="_blank">
                                                        <img class="avatar-lg"
                                                            src="{{ asset('uploads') }}/ads/{{ $data->image }}"
                                                            alt="{{ $data->heading }}">
                                                    </a>
                                                @else
                                                    <span class="badge badge-warning">No Image Found!</span>
                                                @endif
                                            </td>

                                            <td>{{ \Carbon\Carbon::parse($data->updated_at)->format('d M Y h:i A') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('categories.ad_edit', [$data->id]) }}"
                                                    class="btn btn-primary waves-effect waves-light btn-xs"><i
                                                        class="fas fa-edit"></i></a>
                                                <button data-value="{{ $data->id }}"
                                                    class="btn btn-danger waves-effect waves-light btn-xs cdelete"><i
                                                        class="fas fa-trash"></i></button>
                                                <form id="deleteform{{ $data->id }}" method="post"
                                                    action="{{ route('categories.ad_destroy', [$data->id]) }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
    </div> <!-- end container-fluid -->
</div> <!-- end content -->
@endsection

@section('csscodes')
<link href="{{ asset('admin_assets') . '/libs/datatables/dataTables.bootstrap4.min.css' }}" rel="stylesheet">
<link href="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.css' }}" rel="stylesheet">

<!-- Sweet Alert-->
<link href="{{ asset('admin_assets') . '/libs/sweetalert2/sweetalert2.min.css' }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('admin_assets') . '/libs/dropify/dropify.min.css' }}">
@endsection

@section('jscodes')
<!-- Tables -->
<script src="{{ asset('admin_assets') . '/libs/datatables/jquery.dataTables.min.js' }}"></script>
<script src="{{ asset('admin_assets') . '/libs/datatables/dataTables.bootstrap4.min.js' }}"></script>

<script src="{{ asset('admin_assets') . '/libs/datatables/dataTables.responsive.min.js' }}"></script>
<script src="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.js' }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('admin_assets') . '/libs/sweetalert2/sweetalert2.min.js' }}"></script>

<!-- Init js-->
<script src="{{ asset('admin_assets') . '/js/pages/datatables.init.js' }}"></script>
<script src="{{ asset('admin_assets') . '/js/pages/sweet-alerts.init.js' }}"></script>
<script>
    $('.cdelete').on('click', function() {
        var id = $(this).data('value');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#E73E08",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "<span style='font-size: 14px;'>Yes, delete it!</span>",
            cancelButtonText: "<span style='font-size: 14px;'>Cancel</span>",
        }).then(function(t) {
            if (t.value == true) {
                $("#deleteform" + id).submit();
            }
        })
    });
</script>
<script language="javascript">
    $('#example').DataTable({
        responsive: true
    });
</script>
<!-- Plugins js -->
<script src="{{ asset('admin_assets') . '/libs/dropify/dropify.min.js' }}"></script>

<!-- Init js-->
<script src="{{ asset('admin_assets') . '/js/pages/form-fileuploads.init.js' }}"></script>
<script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>

<script>
    setTimeout(function() {
        const editors = document.getElementsByClassName("ckeditor-desc");
        for (let i = 0; i < editors.length; i++) {
            CKEDITOR.replace(editors[i]);
        }
    }, 50);
</script>
<script>
    $('#save').on('click', function() {
        if ($('#image').val() === '') {
            alert('Please Select Image');
        }
    });
    $('#image').on('change', function() {
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
@endsection
