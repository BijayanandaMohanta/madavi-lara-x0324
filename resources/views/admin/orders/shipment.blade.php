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
                                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Order</a></li>
                                <li class="breadcrumb-item active">Shipment</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Shipment
                    @endsection
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="page-title">Shipment</h4>
                            </div>
                        </div>
                        <hr>
                        <form id="form" method="post" action="{{ route('shipment_generate') }}"
                            enctype="multipart/form-data">@csrf
                            <input type="hidden" name="sid" value="{{ $sid }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pickup_location">Pickup Location * :</label>
                                        <select type="text"class="form-control" name="pickup_location">
                                            @foreach ($address_list as $address)
                                                <option value="{{ $address['pickup_location'] }}"
                                                @if ($address['pickup_location'] == $shipment_cookie->pickup_location??'')
                                                    selected
                                                @endif
                                                >
                                                    {{ $address['pickup_location'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('pickup_location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="length">Length * :</label>
                                        <input type="text"class="form-control" name="length" value="{{$shipment_cookie->length??''}}"></input>
                                        @error('length')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small>[The length of the item in cms. Must be more than 0.5]</small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="breadth">Breadth * :</label>
                                        <input type="text"class="form-control" name="breadth" value="{{$shipment_cookie->breadth??''}}"></input>
                                        @error('breadth')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small>[The breadth of the item in cms. Must be more than 0.5]</small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="height">Height * :</label>
                                        <input type="text"class="form-control" name="height" value="{{$shipment_cookie->height??''}}"></input>
                                        @error('height')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small>[The height of the item in cms. Must be more than 0.5]</small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="weight">Weight * :</label>
                                        <input type="text"class="form-control" name="weight" value="{{$shipment_cookie->weight??''}}"></input>
                                        @error('weight')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <small>[The weight of the item in cms. Must be more than 0]</small>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <input type="submit" name="submit" id="save" class="btn btn-success"
                                        value="Create">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div> <!-- end container-fluid -->
</div> <!-- end content -->
@endsection
@section('csscodes')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-toast-plugin@1.3.2/dist/jquery.toast.min.css">
@endsection
@section('jscodes')
<script src="https://cdn.jsdelivr.net/npm/jquery-toast-plugin@1.3.2/dist/jquery.toast.min.js"></script>
<script>
@if (session('error'))
    $.toast({
        heading: 'Error',
        text: "{{session('error')}}",
        icon: 'warning',
        position: 'bottom-right',
        loader: false, 
    });
@endif
</script>
@endsection
