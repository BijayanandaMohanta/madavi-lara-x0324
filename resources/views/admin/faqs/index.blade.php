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
                                <li class="breadcrumb-item active">Faqs</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Faqs
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
                                <h4 class="page-title">Faqs</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('faq.create') }}">
                                    <button class="btn btn-success btn-sm float-right ml-2"><i class="fas fa-plus"></i>
                                        Add Faq
                                    </button>
                                </a>
                            </div>
                        </div>
                        <hr>

                        <div class="table-responsive mt-2">
                            <table class="table table-striped table-bordered dt-responsive wrap" id="example"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Question</th>
                                        <th>Manage Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqs as $key => $data)
                                        <tr>
                                            <td>{{ $key+1 }}
                                            </td>
                                            <td>{{ $data->question }}</td>

                                            <td>
                                                <a href="{{ route('faq_image.edit', [$data->id]) }}"
                                                    class="btn btn-info waves-effect waves-light btn-xs"
                                                    style="display: flex;align-items: center;gap: 2px;">
                                                    Image <i class="fas fa-plus-circle"></i></a>

                                            </td>
                                            <td class="d-flex" style="gap: 3px;">
                                                <a href="{{ route('faq.edit', [$data->id]) }}"
                                                    class="btn btn-info waves-effect waves-light btn-xs"><i
                                                        class="fas fa-edit"></i></a>


                                                <button data-value="{{ $data->id }}"
                                                    class="btn btn-danger waves-effect waves-light btn-xs cdelete"><i
                                                        class="fas fa-trash"></i></button>

                                                <form id="deleteform{{ $data->id }}" method="post"
                                                    action="{{ route('faq.destroy', [$data->id]) }}">
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
