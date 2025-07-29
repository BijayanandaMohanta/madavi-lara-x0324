@extends('admin.layouts.main')
@section('content')
    {{-- @php
    dd(Auth::user());
@endphp --}}
    {{-- @php
    $routesPath = base_path('routes/web.php');

if (file_exists($routesPath)) {
    $routesContent = file_get_contents($routesPath);
    echo $routesContent;
}
@endphp --}}

    {{-- @dd($ordersByMonth); --}}

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>

        </div>
        <!-- end page title -->
    </div>
    <style>
        .icon>i {
            font-size: 1.2rem;
        }

        .card {
            border: none;
        }
    </style>
    <div class="row">
        <div class="col-lg-6">
            <h4 class="page-title">Welcome {{ Auth::User()->name }} !</h4>
            <div class="row">
               
                    
                    <div class="col-xl-6 col-md-6">
                        <div class="card widget-box-two bg-primary">
                            <a href="{{ route('product.index') }}">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body wigdet-two-content">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <p class="m-0 text-uppercase text-white">No. of Product</p>
                                                    <h2 class="text-white">
                                                        <span data-plugin="counterup">{{ $products }}</span>
                                                    </h2>
                                                </div>
                                                <div class="rounded-circle bg-white text-primary d-flex justify-content-center align-items-center icon"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="fas fa-cube"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                   
                
            </div>
        </div>

    </div>
@endsection
