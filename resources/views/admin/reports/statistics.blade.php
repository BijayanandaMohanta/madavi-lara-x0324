@extends('admin.layouts.main')

@section('content')
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                                <li class="breadcrumb-item active">Statistics Report</li>
                            </ol>
                        </div>
                    @section('page_title')
                        Statistics Report
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
                                <div class="col-md-6">
                                    <h4 class="page-title">Statistics</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="btn btn-dark" onclick="window.print();">Print <i
                                            class="fa fa-print"></i></div>
                                </div>
                            </div>
                            <hr>
                            <style>
                                @media print {
                                    #form {
                                        display: none;
                                    }

                                    body {
                                        background-color: unset;
                                    }
                                }
                            </style>
                            <form id="form" method="get" action="" enctype="multipart/form-data">
                                <div class="row m-b-12">
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
                                            <select class="form-control @error('payment_option') is-invalid @enderror"
                                                name="payment_option" id="payment_option">
                                                <option value="">Payment Option</option>
                                                <option value="UPI"
                                                    {{ request('payment_option') == 'UPI' ? 'selected' : '' }}>UPI
                                                </option>
                                                <option value="Card"
                                                    {{ request('payment_option') == 'Card' ? 'selected' : '' }}>Card
                                                </option>
                                                <option value="Cash"
                                                    {{ request('payment_option') == 'Cash' ? 'selected' : '' }}>Cash
                                                </option>
                                                <option value="Pay Online"
                                                    {{ request('payment_option') == 'Pay Online' ? 'selected' : '' }}>
                                                    Pay Online</option>
                                                <option value="Pay Partial COD"
                                                    {{ request('payment_option') == 'Pay Partial COD' ? 'selected' : '' }}>
                                                    Pay Partial COD</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label class="control-label">Order From</label>
                                            <select class="form-control @error('order_from') is-invalid @enderror"
                                                name="order_from" id="order_from">
                                                <option value="">Order From</option>
                                                <option value="Tele Order"
                                                    {{ request('order_from') == 'Tele Order' ? 'selected' : '' }}>
                                                    Offline</option>
                                                <option value="Online"
                                                    {{ request('order_from') == 'Online' ? 'selected' : '' }}>Online
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">

                                            <button type="submit" class="btn btn-primary w-100"><i
                                                    class="fa fa-filter"></i> Apply Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="container mt-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Display the counts -->
                                        <span class="text-success">Last 6 Month's Ordered Delivered :
                                            {{ $ordersDelivered }}</span><br>
                                        <span class="text-danger">Last 6 Month's Ordered Cancelled :
                                            {{ $ordersCancelled }}</span> <br><br>

                                        <!-- Canvas for the pie chart -->
                                        <div style="width: 400px; height: 400px;">
                                            <canvas id="pie-chart"></canvas>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <span>Last 6 Month's Order Flow</span> <br><br><br>
                                        <div style="width: 100%; height: 400px;">
                                            <canvas id="order-flow-chart" height="600" width="800"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <span>Collection Performance</span>
                                        <div style="width: 100%; height: 400px;">
                                            <canvas id="collection-performance-chart" height="400"></canvas>
                                        </div>
                                        <br><br>
                                        <span class='text-primary'>Offline (Tele Order) :
                                            {{ $totalOffline }}</span><br>
                                        <span class="text-success">Online Order : {{ $totalOnline }}</span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
        </div> <!-- end container-fluid -->
    </div> <!-- end content -->
@endsection

@section('csscodes')
    <link href="{{ asset('admin_assets') . '/libs/datatables/responsive.bootstrap4.min.css' }}" rel="stylesheet">
@endsection

@section('jscodes')
    <!-- Initialize the pie chart with animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('pie-chart').getContext('2d');

            const pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Delivered', 'Cancelled'],
                    datasets: [{
                        data: [{{ $ordersDelivered }}, {{ $ordersCancelled }}],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)', // Green for Delivered
                            'rgba(255, 99, 132, 0.6)' // Red for Cancelled
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)', // Green border for Delivered
                            'rgba(255, 99, 132, 1)' // Red border for Cancelled
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutQuad',
                        animateRotate: true,
                        animateScale: true
                    }
                }
            });
        });
    </script>
    <!-- Initialize bar with line chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('order-flow-chart').getContext('2d');

            const orderFlowChart = new Chart(ctx, {
                type: 'bar', // Main chart type is bar
                data: {
                    labels: @json($labels), // Months (e.g., ['2023-10', '2023-09', ...])
                    datasets: [{
                            label: 'Delivered Orders',
                            data: @json($deliveredData), // Delivered orders data
                            backgroundColor: 'rgba(75, 192, 192, 0.6)', // Green
                            borderColor: 'rgba(75, 192, 192, 1)', // Green border
                            borderWidth: 1,
                            type: 'bar' // Bar chart for delivered orders
                        },
                        {
                            label: 'Cancelled Orders',
                            data: @json($cancelledData), // Cancelled orders data
                            backgroundColor: 'rgba(255, 99, 132, 0.6)', // Red
                            borderColor: 'rgba(255, 99, 132, 1)', // Red border
                            borderWidth: 1,
                            type: 'line', // Line chart for cancelled orders
                            fill: false // Do not fill under the line
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true, // Stack bars on the x-axis
                        },
                        y: {
                            stacked: false, // Do not stack bars on the y-axis
                            beginAtZero: true, // Start y-axis from 0
                            ticks: {
                                stepSize: 1, // Ensure y-axis only shows whole numbers
                                precision: 0 // Avoid decimal places
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true,
                            callbacks: {
                                label: function(context) {
                                    // Ensure tooltips show whole numbers
                                    return context.dataset.label + ': ' + Math.round(context.raw);
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 1000, // Animation duration
                        easing: 'easeInOutQuad' // Smooth easing
                    }
                }
            });
        });
    </script>

    <!-- Initialize bar chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('collection-performance-chart').getContext('2d');

            const collectionPerformanceChart = new Chart(ctx, {
                type: 'bar', // Vertical bar chart
                data: {
                    labels: @json($labelsCollection), // Months (e.g., ['2025-Jan', '2025-Feb', ...])
                    datasets: [{
                            label: 'Offline (Tele Order)',
                            data: @json($offlineData), // Offline orders data
                            backgroundColor: 'rgba(54, 162, 235, 0.6)', // Blue
                            borderColor: 'rgba(54, 162, 235, 1)', // Blue border
                            borderWidth: 1
                        },
                        {
                            label: 'Online',
                            data: @json($onlineData), // Online orders data
                            backgroundColor: 'rgba(255, 99, 132, 0.6)', // Red
                            borderColor: 'rgba(255, 99, 132, 1)', // Red border
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Disable aspect ratio to use explicit height
                    indexAxis: 'x', // Vertical bars (default)
                    scales: {
                        x: {
                            stacked: false, // Do not stack bars
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            stacked: false, // Do not stack bars
                            beginAtZero: true, // Start y-axis from 0
                            title: {
                                display: true,
                                text: 'Number of Orders'
                            },
                            ticks: {
                                // Ensure y-axis ticks are whole numbers
                                callback: function(value) {
                                    if (value % 1 === 0) { // Check if the value is a whole number
                                        return value;
                                    }
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    animation: {
                        duration: 1000, // Animation duration
                        easing: 'easeInOutQuad' // Smooth easing
                    }
                }
            });
        });
    </script>
@endsection
