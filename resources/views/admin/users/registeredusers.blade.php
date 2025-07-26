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
                                <li class="breadcrumb-item active">Customers</li>
                            </ol>
                        </div>
                        @section('page_title')
                            Customers
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
                                    <h4 class="page-title">Customers</h4>
                                </div>
                                {{-- <div class="col-md-6">
                                    <a href="{{ route('users.create') }}">
                                        <button class="btn btn-success btn-sm float-right ml-2"><i
                                                class="fas fa-plus"></i>
                                            Add User
                                        </button>
                                    </a>
                                </div> --}}
                                <div class="col-md-6">
                                    <a href="{{ route('export_reg_user') }}"
                                        class="btn btn-success btn-sm float-right ml-2">Export Registered Users</a>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                       
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $key => $data)
                                        <tr>
                                            <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->mobile }}</td>
                                          
                                        
                                            <td>
                                                @if ($data->otp_status == "Verified")
                                                    <span class="badge badge-success">{{ $data->otp_status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $data->otp_status }}</span>
                                                @endif
                                            </td>
                                            
                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y h:i A') }}</td>
                                            <td>
                                                
                                                <button data-value="{{ $data->id }}"
                                                         class="btn btn-danger waves-effect waves-light btn-xs cdelete">
                                                    <i class="fas fa-trash"></i></button>
                                                   <form id="deleteform{{ $data->id }}" method="post"
                                                        action="{{ route('deleteregisteredusers', [$data->id]) }}">
                                                        @csrf
                                                       {{ method_field('DELETE') }}
                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination">
                                    {{ $users->links() }}
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
    <link href="{{ asset('admin_assets') . '/libs/sweetalert2/sweetalert2.min.css' }}" rel="stylesheet" type="text/css"/>
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
@endsection
