
@extends('frontend.layouts.main')
@section('content')
<div class="breadcrumb-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                <div class="breadcrumb-content">
                    <ul class="nav">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li>Payment Policy</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-xxl-12 col-xl-12 col-lg-12">
            <h3 class="subpagetitle">Payment Policy</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-12 col-xl-12 col-lg-12 cmsbox">
            {!!$data->description!!}
        </div>
    </div>
</div>
@endsection