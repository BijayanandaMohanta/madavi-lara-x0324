@extends('frontend.layouts.main')
@section('content')
    @if ($order ?? null && $newtoken)
        @php
            $track = (new \App\Http\Controllers\HelperController())->trackOrder($newtoken, $order->ship_shipment_id);
            $awb_code = $track['tracking_data']['shipment_track'][0]['awb_code'] ?? "...";
            $track_url = $track['tracking_data']['track_url'] ?? "...";
            $pickup_partner = $track['tracking_data']['shipment_track'][0]['pickup_partner'] ?? "...";
            $current_status = $track['tracking_data']['shipment_track'][0]['current_status'] ?? null; // Ensure current_status is defined
        @endphp
        @if ($current_status)
            <div class="dashboardlayout">
                <div class="container-fluid pt-4 pb-4">
                    <div class="row trackorderbox">
                        <div class="col-xxl-12 col-xl-12 col-lg-12">
                            <h3>Track Order</h3>
                            <div class="row justify-content-center">
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-8">
                                    <form class="trackseach">
                                        <input type="text" class="form-control" placeholder="Order ID"
                                            value="{{ $order->order_id }}" name="order_id" id="order_id">
                                        <button type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-xxl-8 col-xl-8 col-lg-8">
                                    <div class="tracksteps">
                                        @if (
                                            $current_status == 'Shipped' ||
                                                $current_status == 'In Transit' ||
                                                $current_status == 'Out for Delivery' ||
                                                $current_status == 'Delivered')
                                            <div class="stepbox">
                                                <div class="icon"><object
                                                        data="{{ asset('frontend/images/dashboard/trackicon-1.svg') }}"
                                                        type="image/svg+xml"></object></div>
                                                <div class="icon-title">Shipped</div>
                                            </div>
                                        @endif
                                        @if (
                                            $current_status == 'Shipped' ||
                                                $current_status == 'In Transit' ||
                                                $current_status == 'Out for Delivery' ||
                                                $current_status == 'Delivered')
                                            <div class="stepbox">
                                                <div class="icon"><object
                                                        data="{{ asset('frontend/images/dashboard/trackicon-2.svg') }}"
                                                        type="image/svg+xml"></object></div>
                                                <div class="icon-title">In Transit</div>
                                            </div>
                                        @endif
                                        @if ($current_status == 'In Transit' || $current_status == 'Out for Delivery' || $current_status == 'Delivered')
                                            <div class="stepbox">
                                                <div class="icon"><object
                                                        data="{{ asset('frontend/images/dashboard/trackicon-3.svg') }}"
                                                        type="image/svg+xml"></object></div>
                                                <div class="icon-title">Out for Delivery</div>
                                            </div>
                                        @endif
                                        @if ($current_status == 'Delivered')
                                            <div class="stepbox">
                                                <div class="icon"><object
                                                        data="{{ asset('frontend/images/dashboard/trackicon-4.svg') }}"
                                                        type="image/svg+xml"></object></div>
                                                <div class="icon-title">Delivery</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-11">
                                    <div class="row justify-content-center">
                                        <div class="col-xxl-5 col-xl-5 col-lg-5">
                                            <div class="dashwidget trackshipping px-0">
                                                <h4>Shipping Summary</h4>
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        <p>order Id.</p>
                                                        <h5>{{ $order->order_id }}
                                                        </h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>Pickup Date</p>
                                                        <h5>{{ $track['tracking_data']['shipment_track'][0]['pickup_date'] }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        <p>Awb Code</p>
                                                        <h5>{{ $awb_code }}</h5>
                                                        </h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>Tracking URL</p>
                                                        <h5><a href="{{ $track_url }}" target="_blank">Click Here</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        <p>Current Status</p>
                                                        <h5>{{ $current_status }}
                                                        </h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>Date of Delivery</p>
                                                        <h5>{{ $track['tracking_data']['shipment_track'][0]['delivered_date'] }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        <p>Delivered to</p>
                                                        <h5>{{ $track['tracking_data']['shipment_track'][0]['delivered_to'] }}
                                                        </h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>Origin City</p>
                                                        <h5>{{ $track['tracking_data']['shipment_track'][0]['origin'] }}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-xxl-5 col-xl-5 col-lg-5">
                                            <div class="dashwidget trackshipping px-0">
                                                <h4>Shipping Details</h4>
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        <p>No. of Items</p>
                                                        <h5>{{ $track['tracking_data']['shipment_track'][0]['packages'] }}
                                                        </h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>Weight</p>
                                                        <h5>{{ $track['tracking_data']['shipment_track'][0]['weight'] }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        <p>Received By</p>
                                                        <h5>{{ $track['tracking_data']['shipment_track'][0]['consignee_name'] }}
                                                        </h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>Destination City</p>
                                                        <h5>{{ $track['tracking_data']['shipment_track'][0]['destination'] }}
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="col-6">
                                                        <p>Shipment Type</p>
                                                        <h5>Information not Available</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <p>Origin City</p>
                                                        <h5>Information not Available</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10">
                                            <div class="col-md-12">
                                                <div class="data-table">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr class="bg-default">
                                                                <th class="text-center">LOCATION</th>
                                                                <th class="text-center">DATE</th>
                                                                <th class="text-center">ACTIVITY</th>
                                                            </tr>

                                                            @php
                                                                $details =
                                                                    $track['tracking_data'][
                                                                        'shipment_track_activities'
                                                                    ];
                                                                $c = isset($details) ? count($details) : 0;
                                                            @endphp

                                                            @for ($i = 0; $i < $c; $i++)
                                                                <tr class="text-center">
                                                                    <td>{{ $details[$i]['location'] }}</td>
                                                                    <td>{{ $details[$i]['date'] }}</td>
                                                                    <td>{{ $details[$i]['activity'] }}</td>
                                                                </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h3 align="center" class="py-4">#{{ $order->order_id }} Order Status is "{{ $order->order_status }}"</h3>
        @endif
    @else
        <div class="dashboardlayout">
            <div class="container-fluid pt-4 pb-4">
                <div class="row trackorderbox">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <h3>Track Order</h3>
                        <div class="row justify-content-center">
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-8">
                                <form class="trackseach">
                                    <input type="text" class="form-control" placeholder="Order ID" name="order_id"
                                        id="order_id">
                                    <button type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-8">
                                @php
                                    if (session('error')) {
                                        echo '<div class="alert alert-danger mt-3">' . session('error') . '</div>';
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
