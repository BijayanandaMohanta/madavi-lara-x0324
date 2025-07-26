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
                                <li class="breadcrumb-item active">Video Reviews</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Video Reviews
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
                                <h4 class="page-title">Video Reviews</h4>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('videoreviews.create') }}">
                                    <button class="btn btn-success btn-sm float-right ml-2"><i class="fas fa-plus"></i>
                                        Add Video Review
                                    </button>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Video</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        function get_video_id($url)
                                                        {
                                                            preg_match('/shorts\/([a-zA-Z0-9_-]+)/', $url, $matches);
                                                            return $videoId = $matches[1] ?? null;
                                                        }
                                    @endphp
                                    @foreach ($videos as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{-- @if ($data->video != '')
                                                    <a href="{{ asset('uploads/videos') }}/{{ $data->video }}"
                                                       target="_blank">
                                                        <video class="avatar-lg"
                                                             src="{{ asset('uploads/videos') }}/{{ $data->video }}" >
                                                    </a>
                                                @else
                                                    <span class="badge badge-warning">No Video</span>
                                                @endif --}}
                                                @if ($data->link != '#')
                                                    @php
                                                        $url = $data->link;
                                                        
                                                        $video_id = get_video_id($data->link);
                                                        $video_url = 'https://www.youtube.com/embed/' . $video_id;
                                                        // echo $video_url;
                                                    @endphp
                                                    <iframe width="200" style="aspect-ratio: 9/16;" src="{{ $video_url }}"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen></iframe>
                                                @else
                                                    Video not found!
                                                @endif
                                            </td>

                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y h:i A') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('videoreviews.edit', [$data->id]) }}"
                                                    class="btn btn-info waves-effect waves-light btn-xs"><i
                                                        class="fas fa-edit"></i></a>
                                                <button data-value="{{ $data->id }}"
                                                    class="btn btn-danger waves-effect waves-light btn-xs cdelete">
                                                    <i class="fas fa-trash"></i></button>
                                                <form id="deleteform{{ $data->id }}" method="post"
                                                    action="{{ route('videoreviews.destroy', [$data->id]) }}">
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
