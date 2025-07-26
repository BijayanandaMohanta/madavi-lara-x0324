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
                                <li class="breadcrumb-item active">CMS Pages</li>
                            </ol>
                        </div>
                    @section('page_title')
                        CMS Pages
                    @endsection
                    <h4 class="page-title">CMS Pages</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Success!</strong> {{ Session::get('message') }}
                            </div>
                        @endif


                        @if (count($pages) > 0)
                            <table id="datatable-buttons"
                                class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Page Name</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($pages as $key => $page)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $page->name }}</td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($page->updated_at)) }}</td>
                                            <td>
                                                <a href="{{ route('pages.edit', [$page->id]) }}"
                                                    class="btn btn-info waves-effect waves-light btn-xs"><i
                                                        class="fas fa-edit"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @else
                            <h5 align='center'>Not Data Found.</h5>
                        @endif

                    </div>
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>



    </div> <!-- end container-fluid -->

</div> <!-- end content -->




@endsection
