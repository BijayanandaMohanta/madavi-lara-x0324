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
                                <li class="breadcrumb-item active">Notify Requests</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Notify Requests
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
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h4 class="page-title">Notify Requests</h4>
                            </div>
                            
                        </div>
                        <form id="form" method="get" action=""
                                enctype="multipart/form-data">@csrf
                                <div class="row m-b-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">From Date</label>
                                            <input type="date"
                                                class="form-control @error('from_date') is-invalid @enderror"
                                                name="from_date" id="from_date" value="{{ request('from_date', '') }}"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                onchange="$('#to_date').attr({'min': this.value});">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">To Date</label>
                                            <input type="date"
                                                class="form-control @error('to_date') is-invalid @enderror"
                                                name="to_date" id="to_date" value="{{ request('to_date', '') }}"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" style="color: aliceblue;">.</label>
                                        <button type="submit" class="btn btn-outline-primary w-100"><i
                                                class="fa fa-filter"></i> Apply Filter</button>
                                    </div>
                                </div>
                                </div>
                        </form>
                        <hr>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive wrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Request At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notify as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $data->customer->name }}</td>
                                            <td>{{ $data->product->name ?? "Product removed!" }}</td>
                                           
                                            <td> <span
                                                    class="badge badge-success">{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y h:i A') }}</span>
                                            </td>
                                            {{-- <td>
                                                <a href="{{ route('coupon.edit', [$data->id]) }}"
                                                    class="btn btn-info waves-effect waves-light btn-xs"><i
                                                        class="fas fa-edit"></i></a>


                                                <button data-value="{{ $data->id }}"
                                                    class="btn btn-danger waves-effect waves-light btn-xs cdelete"><i
                                                        class="fas fa-trash"></i></button>

                                                <form id="deleteform{{ $data->id }}" method="post"
                                                    action="{{ route('coupon.destroy', [$data->id]) }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </td> --}}
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
