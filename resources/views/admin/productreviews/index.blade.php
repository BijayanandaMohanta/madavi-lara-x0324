@extends('admin.layouts.main')

@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 24px;
        }
        .switch1 {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 24px;
        }

        .switch-input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .switch-input1 {
            opacity: 0;
            width: 0;
            height: 0;
        }


        .slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            border-radius: 24px;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 19px;
            width: 20px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            border-radius: 50%;
            transition: .4s;
        }

        .switch-input:checked+.slider {
            background-color: #2196F3;
        }

        .switch-input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        .switch-input:checked+.slider:before {
            transform: translateX(16px);
        }
        .switch-input1:checked+.slider {
            background-color: #2196F3;
        }

        .switch-input1:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        .switch-input1:checked+.slider:before {
            transform: translateX(16px);
        }
    </style>
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
                                <li class="breadcrumb-item active">Product reviews</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Product reviews
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
                            <div class="col-md-6">
                                <h4 class="page-title">Product reviews</h4>
                            </div>

                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive wrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th>Home Display</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productreviews as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                    {{ $data->created_at }}
                                                </td>
                                            <td>{{ $data->product->name ?? "Product deleted" }}</td>
                                            <td>{{ $data->rating }}</td>
                                            <td>{{ $data->review }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="switch-input"
                                                        data-review-id="{{ $data->id }}"
                                                        {{$data->status == 1 ? 'checked' : ''}}
                                                        >
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <label class="switch1">
                                                    <input type="checkbox" class="switch-input1"
                                                        data-review-id="{{ $data->id }}"
                                                        {{$data->home_display == 1 ? 'checked' : ''}}
                                                        >
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>

                                            <td class="d-flex" style="gap: 3px;">


                                                <button data-value="{{ $data->id }}"
                                                    class="btn btn-danger waves-effect waves-light btn-xs cdelete"><i
                                                        class="fas fa-trash"></i></button>

                                                <form id="deleteform{{ $data->id }}" method="post"
                                                    action="{{ route('productreviews.destroy', [$data->id]) }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- <script>
                                const switches = document.querySelectorAll('.switch-input');
                              
                                switches.forEach(switchElement => {
                                  switchElement.addEventListener('change', function() {
                                    if (this.checked) {
                                      console.log('Switch is on');
                                    } else {
                                      console.log('Switch is off');
                                    }
                                  });
                                });
                              </script> --}}

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
    const switches = document.querySelectorAll('.switch-input');

    switches.forEach(switchElement => {
        switchElement.addEventListener('change', 
            function() {
                const reviewId = this.dataset.reviewId;

                if (this.checked) {
                    // Switch is on: Send AJAX request
                    $.ajax({
                        url: "{{ route('update_review_status') }}", // Replace with your actual route
                        type: "GET",
                        data: {
                            review_id: reviewId,
                            _token: "{{ csrf_token() }}" // Ensure CSRF protection
                        },
                        dataType: "json", // Expect JSON response
                        success: function(response) {
                            if (response.status === 'success') {
                                // Update UI or handle success (optional)
                                console.log('Review status updated successfully.');
                            } else {
                                console.error('Error updating review status:', response
                                .message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', xhr.statusText, error);
                        }
                    });
                } else {
                    // Switch is off: You may handle differently if needed
                    $.ajax({
                        url: "{{ route('update_review_status') }}", // Replace with your actual route
                        type: "GET",
                        data: {
                            review_id: reviewId,
                            _token: "{{ csrf_token() }}" // Ensure CSRF protection
                        },
                        dataType: "json", // Expect JSON response
                        success: function(response) {
                            if (response.status === 'success') {
                                // Update UI or handle success (optional)
                                console.log('Review status updated successfully.');
                            } else {
                                console.error('Error updating review status:', response
                                .message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', xhr.statusText, error);
                        }
                    });
                }
            });
    });
</script>
<script>
    const switches1 = document.querySelectorAll('.switch-input1');

    switches1.forEach(switchElement => {
        switchElement.addEventListener('change', 
            function() {
                const reviewId = this.dataset.reviewId;

                if (this.checked) {
                    // Switch is on: Send AJAX request
                    $.ajax({
                        url: "{{ route('update_review_status_home') }}", // Replace with your actual route
                        type: "POST",
                        data: {
                            review_id: reviewId,
                            _token: "{{ csrf_token() }}" // Ensure CSRF protection
                        },
                        dataType: "json", // Expect JSON response
                        success: function(response) {
                            if (response.status === 'success') {
                                // Update UI or handle success (optional)
                                console.log('Review status updated successfully.');
                            } else {
                                console.error('Error updating review status:', response
                                .message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', xhr.statusText, error);
                        }
                    });
                } else {
                    // Switch is off: You may handle differently if needed
                    $.ajax({
                        url: "{{ route('update_review_status_home') }}", // Replace with your actual route
                        type: "POST",
                        data: {
                            review_id: reviewId,
                            _token: "{{ csrf_token() }}" // Ensure CSRF protection
                        },
                        dataType: "json", // Expect JSON response
                        success: function(response) {
                            if (response.status === 'success') {
                                // Update UI or handle success (optional)
                                console.log('Review status updated successfully.');
                            } else {
                                console.error('Error updating review status:', response
                                .message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX error:', xhr.statusText, error);
                        }
                    });
                }
            });
    });
</script>





@endsection
