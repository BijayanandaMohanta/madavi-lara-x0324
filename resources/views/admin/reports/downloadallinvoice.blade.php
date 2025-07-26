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
                                <li class="breadcrumb-item active">Download invoices</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Downlaod invoices
                    @endsection
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Error!</strong> {{ Session::get('message') }}
                                </div>
                            @endif

                            @include('flash_msg')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="page-title">Download Invoices</h4>
                                    <div class="alert alert-warning text-center" role="alert">
                                        <i class="fas fa-exclamation-triangle"></i> Please make sure to select date range and cross check your internet connection before downloading request. <br> Please don't refresh the page or click many times on button until the page process is not completed.
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <form id="form" method="get" action="{{ route('download-all-invoice') }}" enctype="multipart/form-data">
                                <div class="row m-b-12 justify-content-center">
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">From Date</label>
                                            <input type="date"
                                                class="form-control @error('from_date') is-invalid @enderror"
                                                name="from_date" id="from_date" value="{{ request('from_date', '') }}"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                onchange="$('#to_date').attr({'min': this.value});">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">To Date</label>
                                            <input type="date"
                                                class="form-control @error('to_date') is-invalid @enderror"
                                                name="to_date" id="to_date" value="{{ request('to_date', '') }}"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Payment Option</label>
                                            <select multiple
                                                class="form-control @error('payment_option') is-invalid @enderror"
                                                name="payment_option[]" id="payment_option" size="5">
                                                <option value="">Payment Option</option>
                                                <option value="UPI"
                                                    {{ in_array('UPI', request('payment_option', [])) ? 'selected' : '' }}>
                                                    UPI
                                                </option>
                                                <option value="Card"
                                                    {{ in_array('Card', request('payment_option', [])) ? 'selected' : '' }}>
                                                    Card
                                                </option>
                                                <option value="Cash"
                                                    {{ in_array('Cash', request('payment_option', [])) ? 'selected' : '' }}>
                                                    Cash
                                                </option>
                                                <option value="Pay Online"
                                                    {{ in_array('Pay Online', request('payment_option', [])) ? 'selected' : '' }}>
                                                    Pay Online</option>
                                                <option value="Pay Partial COD"
                                                    {{ in_array('Pay Partial COD', request('payment_option', [])) ? 'selected' : '' }}>
                                                    Pay Partial COD</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label" style="color: aliceblue;">.</label>
                                            <button type="submit" class="btn btn-outline-dark w-100"
                                                id="download-invoice-btn">
                                                <i class="fa fa-filter"></i> <span id="download-invoice-text">Download
                                                    Invoices</span>
                                            </button>
                                        </div>
                                    </div>


                                </div>
                            </form>

                            <hr>


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
    <link href="{{ asset('admin_assets') . '/libs/sweetalert2/sweetalert2.min.css' }}" rel="stylesheet"
        type="text/css" />
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
        const submitButton = document.getElementById('download-invoice-btn');
        const buttonText = document.getElementById('download-invoice-text');
        const invoiceForm = document.getElementById('form');
        invoiceForm.addEventListener('submit', ()=>{
            submitButton.disabled = true;
            buttonText.textContent = 'Downloading...';
            // Wait for a few seconds to re-enable (simulate completion)
            setTimeout(() => {
                submitButton.disabled = false;
                buttonText.textContent = 'Download Invoices';
            }, 25000);
        })
    </script>
@endsection
