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
                                <h3>Wishlist ({{ $wishlistProducts->count() }})</h3>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-x-12 col-lg-12">
                            <div class="dashwidget px-0 wishlistbox">
                                @forelse ($wishlistProducts as $product)
                                    <div class="orddetailsbox container-to-hide">
                                        <div class="row justify-content-between">
                                            <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-8">
                                                <div class="itemdetailsrow">
                                                    <div class="itemproduct">
                                                        <div class="itemimg">
                                                            @if ($product->image != 'no-image')
                                                                <img src="{{ asset("uploads/products/$product->image") }}"
                                                                    alt="{{ $product->name }}">
                                                            @else
                                                                <img src="https://placehold.co/400x400?text=No+Image+Found!"
                                                                    alt="Default Image">
                                                            @endif
                                                        </div>
                                                        <div class="itemtitle">
                                                            <a
                                                                href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                                            <div class="itemprice"><label for=""
                                                                    class="d-lg-none d-md-none d-block">Price</label> Rs.
                                                                {{ $product->price }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 align-self-center">
                                                <div class="ordersbox d-flex px-0 align-items-center justify-content-end">
                                                    <a href='javascript:void(0);' onclick="addToCart({{ $product->id }},1)" class="btn-view" contenteditable="false"
                                                        style="cursor: pointer;">Add to cart</a>
                                                    <a href="javascript:void(0);" class="delwishicon" onclick="addtowish('{{Session::get('customer_id')}}','{{$product->id}}')"><i
                                                            class="fal fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <p>No data found.</p>
                                        </div>
                                    </div>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
