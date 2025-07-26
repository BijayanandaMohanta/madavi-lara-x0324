@extends('frontend.layouts.main')
@section('content')
<div class="dashboardlayout">
    <div class="container-fluid pt-4 pb-4">
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-3 d-xxl-block d-xl-block d-lg-block d-none">
                @include('frontend.dashboardmenu')
            </div>
            <div class="col-xxl-9 col-xl-9 col-lg-9">
               <div class="row">

                    <div class="col-xxl-12 col-x-12 col-lg-12">
                        <div class="dashwidget">
                            <div class="float-end sort pt-2">
                                <a href="{{ route('add-address') }}" class="dashnewaddr">+ Add New Address</a>
                            </div>
                            <h3>Manage Address</h3>
                        </div>
                    </div>
                    
                    <div class="col-xxl-12 col-x-12 col-lg-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @foreach($address_lists as $address)
                        <div class="dashwidget px-0 mb-1">
                            <div class="row justify-content-between">
                                <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-7 dashdelvbox pt-1">
                                    <div class="hometxt">{{ $address->type }}</div>
                                    <h5>{{ $address->first_name }} {{ $address->last_name }}, {{ $address->phone }}</h5>
                                    <p>{{ $address->apartment }}, {{ $address->address }}, {{ $address->landmark }},{{ $address->city }}, {{ $address->state }} -{{ $address->pincode }}</p>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-sm-5 align-self-center">
                                    <div class="addressicons">
                                        <a href="{{route('usereditaddress',$address->id)}}" class="addedit"><i class="fal fa-edit"></i></a>
                                        <a href="{{route('deleteaddress',$address->id)}}" class="deladd"><i class="fal fa-trash-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection