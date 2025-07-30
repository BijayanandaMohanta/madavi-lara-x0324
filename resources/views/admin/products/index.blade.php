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
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Products
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
                            <div class="col-md-12 d-flex align-items-center justify-content-between">
                                <h4 class="page-title">Products</h4>
                                <div class="float-right">
                                    <a href="{{ route('product.create') }}">
                                        <button class="btn btn-success btn-sm float-right ml-2"><i
                                                class="fas fa-plus"></i>
                                            Add Product
                                        </button>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <form action="" method="get">
                            <div class="col-6 p-0 m-0 d-flex">
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Search by name" value="{{ request('name') }}">
                                {{-- <select name="sort_by_stock" id="" class="form-control ml-1" width="150">
                                    <option value="">Sort by Stock</option>
                                    <option value="asc" {{ request('sort_by_stock') == 'asc' ? 'selected' : '' }}>
                                        Ascending
                                    </option>
                                    <option value="desc" {{ request('sort_by_stock') == 'desc' ? 'selected' : '' }}>
                                        Descending
                                    </option>
                                </select> --}}
                                <button type="submit" class="btn btn-success ml-1">Search</button>
                            </div>
                        </form>
                        <div class="table-responsive mt-2">
                            <table class="table table-striped table-bordered dt-responsive wrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        {{-- <th>Modified At</th> --}}
                                        <th>Manage Image</th>
                                        <th>Manage Prices</th>
                                        <th>In Stock / Sale</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $data)
                                        <tr>
                                            <td>{{ ($products->currentPage() - 1) * $products->perPage() + $key + 1 }}
                                            </td>

                                            <td>
                                                <span class="badge badge-primary">{{ $data->category->category }}</span>
                                            </td>
                                            <td>{{ $data->name }}</td>

                                            {{-- <td> <span class="badge badge-success">{{ \Carbon\Carbon::parse($data->updated_at)->format('d M Y h:i A') }}</span>
                                            </td> --}}
                                            <td>
                                                <a href="{{ route('product_image.edit', [$data->id]) }}"
                                                    class="btn btn-info waves-effect waves-light btn-xs">
                                                    Upload Image
                                                </a>

                                            </td>
                                            <td>

                                                <a href="{{ route('product-price.index', ['id' => $data->id]) }}"
                                                    class="btn btn-primary waves-effect waves-light btn-xs mb-1">
                                                    Product Prices
                                                </a>

                                            </td>
                                            <td>
                                                <select class="form-control" name="current_status" id="current_status"
                                                    style="width: 120px;"
                                                    onchange="changeCurrentStatus(this.value,{{ $data->id }})">
                                                    >
                                                    <option value="">Choose Status</option>
                                                    <option value="In Stock"
                                                        {{ ($data->current_status ?? '') == 'In Stock' ? 'selected' : '' }}>
                                                        In Stock
                                                    </option>
                                                    <option value="On Sale"
                                                        {{ ($data->current_status ?? '') == 'On Sale' ? 'selected' : '' }}>
                                                        On Sale
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                @if ($data->status == '1')
                                                    <span class="badge badge-success">{{ 'Active' }}</span>
                                                @endif
                                                @if ($data->status == '0')
                                                    <span class="badge badge-danger">{{ 'InActive' }}</span>
                                                @endif
                                            </td>
                                            <td class="d-flex" style="gap: 3px;">
                                                <a href="{{ route('product.edit', [$data->id]) }}"
                                                    class="btn btn-info waves-effect waves-light btn-xs"><i
                                                        class="fas fa-edit"></i></a>
                                                <a href="{{ route('product.duplicate', [$data->id]) }}"
                                                    class="btn btn-info waves-effect waves-light btn-xs"><i
                                                        class="fas fa-copy"></i></a>

                                                <button data-value="{{ $data->id }}"
                                                    class="btn btn-danger waves-effect waves-light btn-xs cdelete"><i
                                                        class="fas fa-trash"></i></button>

                                                <form id="deleteform{{ $data->id }}" method="post"
                                                    action="{{ route('product.destroy', [$data->id]) }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination">
                                {{ $products->appends(['name' => request()->input('name')])->links() }}
                            </div>

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

<script language="javascript">
    $('#example').DataTable({
        responsive: true
    });
</script>
<script>
    function changeCurrentStatus(current_status, id) {
        const url = "{{ route('change_current_status_ajax') }}";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                "_token": "{{ csrf_token() }}",
                "current_status": current_status,
                "id": id
            },
            success: function(data) {
                if (data.status == 'success') {
                    location.reload();
                } else {
                    alert(data.message);
                }
            }
        });
    }

    function showNotification(message, type) {
        // Create a notification element
        var notification = $('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
            message +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>');

        // Append the notification to the body
        $('body').append(notification);

        // Position the notification at the bottom right
        notification.css({
            position: 'fixed',
            bottom: '20px',
            left: '20px',
            zIndex: 1050 // Ensure it appears above other content
        });

        // Automatically remove the notification after 5 seconds
        setTimeout(function() {
            notification.alert('close');
        }, 5000);
    }
</script>
@endsection
