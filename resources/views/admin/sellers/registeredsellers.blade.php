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
                                <li class="breadcrumb-item active">Sellers</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Sellers
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
                                    <h4 class="page-title">Sellers</h4>
                                </div>
                                {{-- <div class="col-md-6">
                                    <a href="{{ route('sellers.create') }}">
                                        <button class="btn btn-success btn-sm float-right ml-2"><i
                                                class="fas fa-plus"></i>
                                            Add User
                                        </button>
                                    </a>
                                </div> --}}
                                
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>GST Number</th>
                                        <th>Store image/ Visiting Cart</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>OTP Status</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($sellers as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->gst_number }}</td>
                                            <td>
                                                @if ($data->proof_image != '')
                                                    <a href="{{ asset('uploads/sellers') }}/{{ $data->proof_image }}"
                                                        target="_blank">
                                                        <img class="avatar-lg"
                                                            src="{{ asset('uploads/sellers') }}/{{ $data->proof_image }}"
                                                            alt="{{ $data->name}}">
                                                    </a>
                                                @else
                                                    <span class="badge badge-warning">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->mobile }}</td>
                                          
                                        
                                            <td>
                                                @if ($data->otp_status == "Verified")
                                                    <span class="badge badge-success">{{ $data->otp_status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $data->otp_status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" class="switch-input"
                                                        data-review-id="{{ $data->id }}"
                                                        {{$data->status == 1 ? 'checked' : ''}}
                                                        >
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            
                                            
                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y h:i A') }}</td>
                                            <td>
                                                
                                                <button data-value="{{ $data->id }}"
                                                         class="btn btn-danger waves-effect waves-light btn-xs cdelete">
                                                    <i class="fas fa-trash"></i></button>
                                                   <form id="deleteform{{ $data->id }}" method="post"
                                                        action="{{ route('deleteregisteredsellers', [$data->id]) }}">
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
    <link href="{{ asset('admin_assets') . '/libs/sweetalert2/sweetalert2.min.css' }}" rel="stylesheet" type="text/css"/>
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
            bottom: 3px;
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
    const switches = document.querySelectorAll('.switch-input');

    switches.forEach(switchElement => {
        switchElement.addEventListener('change', 
            function() {
                const reviewId = this.dataset.reviewId;

                if (this.checked) {
                    // Switch is on: Send AJAX request
                    $.ajax({
                        url: "{{ route('update_seller_status') }}", // Replace with your actual route
                        type: "GET",
                        data: {
                            seller_id: reviewId,
                            _token: "{{ csrf_token() }}" // Ensure CSRF protection
                        },
                        dataType: "json", // Expect JSON response
                        success: function(response) {
                            if (response.status == 'success') {
                                // Update UI or handle success (optional)
                                showNotification('Status updated successfully!', 'success');
                            } else {
                                showNotification('Error updating review status!', 'danger');
                                console.error('Error updating review status:', response
                                .message);
                            }
                        },
                        error: function(xhr, status, error) {
                            showNotification('Error updating review status!', 'danger');
                        }
                    });
                } else {
                    // Switch is off: You may handle differently if needed
                    $.ajax({
                        url: "{{ route('update_seller_status') }}", // Replace with your actual route
                        type: "GET",
                        data: {
                            seller_id: reviewId,
                            _token: "{{ csrf_token() }}" // Ensure CSRF protection
                        },
                        dataType: "json", // Expect JSON response
                        success: function(response) {
                            if (response.status == 'success') {
                                // Update UI or handle success (optional)
                                showNotification('Status updated successfully!', 'success');
                            } else {
                                showNotification('Error updating review status!', 'danger');
                                console.error('Error updating review status:', response
                                .message);
                            }
                        },
                        error: function(xhr, status, error) {
                            showNotification('Error updating review status!', 'danger');
                            console.error('AJAX error:', xhr.statusText, error);
                        }
                    });
                }
            });
    });
</script>
@endsection
