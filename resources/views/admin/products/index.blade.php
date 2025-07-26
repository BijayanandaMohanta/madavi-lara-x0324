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
                                        <button class="btn btn-success btn-sm float-right ml-2"><i class="fas fa-plus"></i>
                                            Add Product
                                        </button>
                                    </a>
                                    <button type="button" class="btn btn-primary btn-sm float-right ml-2"
                                        data-toggle="modal" data-target="#exampleModalImport">
                                        Import
                                    </button>
                                    <a href="{{ route('product_export') }}"
                                        class="btn btn-success btn-sm float-right ml-2">Export Products Price&Stock</a>
                                    <a href="{{ route('product_export_all') }}"
                                        class="btn btn-success btn-sm float-right ml-2">Export All Data</a>
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
                                <button type="submit"
                                    class="btn btn-success ml-1">Search</button>
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
                                        <th>Status</th>
                                        <th width='60'>Price</th>
                                        <th>Stock</th>
                                        {{-- <th>Modified At</th> --}}
                                        <th>Manage Image</th>
                                        <th>Manage Stock</th>
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
                                                <br>
                                                <span
                                                    class="badge badge-dark">{{ $data->subcategory->category ?? '' }}</span>
                                                <br>
                                                <span
                                                    class="badge badge-secondary">{{ $data->childcategory->category ?? '' }}</span>
                                            </td>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                @if ($data->status == '1')
                                                    <span class="badge badge-success">{{ 'Active' }}</span>
                                                @endif
                                                @if ($data->status == '0')
                                                    <span class="badge badge-danger">{{ 'InActive' }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                Price : <span class="price" data-old-price="{{ $data->price }}"
                                                    data-product-id="{{ $data->id }}"
                                                    contenteditable="true">{{ $data->price }}</span>
                                                {{-- <br> --}}
                                                MOP : <span class="mop" data-old-mop="{{ $data->mop }}"
                                                    data-product-id="{{ $data->id }}"
                                                    contenteditable="true">{{ $data->mop }}</span>
                                            </td>

                                            {{-- Style for editable --}}
                                            <style>
                                                .price,
                                                .mop {
                                                    padding: 3px 7px;
                                                    border: 1px dashed #007bff;
                                                    border-radius: 4px;
                                                    background-color: #f8f9fa;
                                                    color: #333;
                                                    cursor: pointer;
                                                    transition: background-color 0.3s, border-color 0.3s;
                                                    display: block;
                                                }

                                                .price:hover,
                                                .mop:hover {
                                                    background-color: #e9ecef;
                                                    border-color: #0056b3;
                                                }

                                                .price:focus,
                                                .mop:focus {
                                                    outline: none;
                                                    border-color: #0056b3;
                                                    /* box-shadow: 0 0 5px rgba(0, 86, 179, 0.5); */
                                                }
                                            </style>



                                            <td>
                                                <span id="product_{{ $data->id }}">{{ $data->stock }}</span>
                                            </td>
                                            {{-- <td> <span class="badge badge-success">{{ \Carbon\Carbon::parse($data->updated_at)->format('d M Y h:i A') }}</span>
                                            </td> --}}
                                            <td>
                                                <a href="{{ route('product_image.edit', [$data->id]) }}"
                                                    class="btn btn-info waves-effect waves-light btn-xs"
                                                    style="display: flex;align-items: center;gap: 2px;">
                                                    Image <i class="fas fa-plus-circle"></i></a>

                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('product_stock.edit', [$data->id]) }}"
                                                    class="btn btn-info waves-effect waves-light btn-xs"
                                                    style="display: flex;align-items: center;gap: 2px;">
                                                    Stock <i class="fas fa-plus-circle"></i></a> --}}

                                                <button type="button"
                                                    class="btn btn-sm btn-primary open-stock-update-modal"
                                                    data-id="{{ $data->id }}" data-name="{{ $data->name }}">
                                                    Stock Update
                                                </button>



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

<script>
    $(document).ready(function() {
        function priceUpdate(element) {
            var content = $(element).html();
            var old_price = $(element).data('oldPrice');
            var product_id = $(element).data('productId');
            $.ajax({
                url: "{{ route('product_price_update') }}",
                type: 'POST',
                data: {
                    content: content,
                    old_price: old_price,
                    product_id: product_id,
                    _token: '{{ csrf_token() }}',
                },
                datatype: 'json',
                success: function(response) {
                    //Success logic if needed I will add it later
                    showNotification('Price updated successfully!', 'success');
                },
                error: function(xhr, status, error) {
                    // console.error('Error saving content:', error);
                    showNotification('Error updating price. Please try again.', 'danger');
                }
            });
        }

        // Handle blur event for .price elements
        $(document).on('blur', '.price', function() {
            priceUpdate(this); // Call the priceUpdate function when the element loses focus
        });

        // Handle keydown event for Enter key in .price elements
        $(document).on('keydown', '.price', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent the default action of creating a new line
                priceUpdate(this); // Call the priceUpdate function
                $(this).blur(); // Optionally blur the input field
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        function mopUpdate(element) {
            var content = $(element).html();
            var old_mop = $(element).data('oldMop');
            var product_id = $(element).data('productId');
            $.ajax({
                url: "{{ route('product_mop_update') }}",
                type: 'POST',
                data: {
                    content: content,
                    old_mop: old_mop,
                    product_id: product_id,
                    _token: '{{ csrf_token() }}',
                },
                datatype: 'json',
                success: function(response) {
                    showNotification('MOP updated successfully!', 'success');
                },
                error: function(xhr, status, error) {
                    // console.error('Error saving content:', error);
                    showNotification('Error updating MOP. Please try again.', 'danger');
                }
            });
        }

        $(document).on('keydown', '.mop', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent new line
                mopUpdate(this); // Call your update function
                $(this).blur(); // Optionally blur the input field
            }
        });

        $(document).on('blur', '.mop', function() {
            if ($(this).text().trim() !== '') { // Check if the input is not empty
                mopUpdate(this);
            }
        });
    });
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModalImport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('product_data_update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Excel File:</label>
                        <input type="file" class="form-control" id="file" name="file" required
                            accept=".xlsx">
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="stockUpdateModal" tabindex="-1" aria-labelledby="stockUpdateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="stockUpdateModalLabel">Stock Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @csrf
                    <p id="product_name"></p>
                    <input type="hidden" name="product_id" id="product_id">
                    <input type="text" name="stock" id="stock" class="form-control mb-2"
                        placeholder="Enter Stock" oninput="validateStockInput(this)" required>
                    <button type="button" name="add-stock" class="btn btn-primary">Add Stock</button>
                    <button type="button" name="remove-stock" class="btn btn-danger">Remove Stock</button>
                    <a href="" id="edit_route"
                        class="btn btn-success">
                        Stock Transactions</a>
                    <br>
                    <div id="success-message" class="mt-2 alert alert-success" style="display: none;"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function validateStockInput(input) {
        // Remove any non-numeric characters (e.g., letters, symbols)
        input.value = input.value.replace(/[^0-9]/g, '');

        // Convert the value to a number
        let value = parseInt(input.value);

        // If the value is 0, negative, or NaN (not a number), clear the input
        if (isNaN(value) || value <= 0) {
            input.value = '';
        }
    }
</script>

<script>
    // Function to open the modal and set the product ID
    $(document).on('click', '.open-stock-update-modal', function() {
        var productId = $(this).data('id');
        var productName = $(this).data('name');
        var edit_route = 'https://openboxwale.in/admin/product_stock/'+productId+'/edit';
        $('#product_id').val(productId);
        $('#product_name').html("Product : " + productName);
        $('#edit_route').attr("href",edit_route);
        $('#stockUpdateModal').modal('show');
    });
</script>

<script>
    $(document).ready(function() {
        $('button[name="add-stock"], button[name="remove-stock"]').click(function() {
            var button = $(this);
            var action = button.attr('name') === 'add-stock' ? 'Credit' : 'Debit';
            var product_id = $('#product_id').val();
            var stock = $('#stock').val();
            var from = "AJAX";
            var message = $('#success-message');
            message.hide();

            // Disable inputs and show processing message
            button.prop('disabled', true).text('Processing...');
            $('#product_id, #stock').prop('disabled', true);

            $.ajax({
                url: '{{ route('product_stock.store') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: product_id,
                    stock: stock,
                    type: action,
                    from: from
                },
                success: function(response) {
                    // Enable inputs and revert button text
                    button.prop('disabled', false).text(action === 'Credit' ? 'Add Stock' :
                        'Remove Stock');
                    $('#product_' + product_id).text(response.product_stock);
                    $('#product_id, #stock').prop('disabled', false);

                    // Clear input fields
                    // $('#product_id').val('');
                    $('#stock').val('');

                    message.text(response.success).show();
                },
                error: function(xhr) {
                    // Enable inputs and revert button text
                    button.prop('disabled', false).text(action === 'Credit' ? 'Add Stock' :
                        'Remove Stock');
                    $('#product_id, #stock').prop('disabled', false);

                    message.text(response.error).show();
                }
            });
        });
    });
</script>
@endsection
