@extends('frontend.layouts.main')
@section('content')
<div class="dashboardlayout">
    <div class="container-fluid pt-4 pb-4">
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-3 d-xxl-block d-xl-block d-lg-block d-none">
                @include('frontend.sellerdashboardmenu')
            </div>
            <div class="col-xxl-9 col-xl-9 col-lg-9">
                <div class="row">
                    <div class="col-xxl-12 col-x-12 col-lg-12">
                        <div class="dashwidget">
                            <h3>Place Order</h3>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-x-12 col-lg-12">
                        <div class="dashwidget">
                            <div class="row justify-content-center">
                                <div class="col-12 py-5">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <div class="row">
            <div class="col-sm-12">
                <div class="card border-0">
                    <div class="card-body">
                       
                        <form id="form" method="post" action="{{ route('tele_orders.store') }}"
                            enctype="multipart/form-data">@csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="name">User Name * :</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" value="{{ old('name') }}"
                                            autocomplete="off">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="mobile">Mobile * :</label>
                                        <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                            name="mobile" id="mobile" value="{{ old('mobile') }}" autocomplete="off"
                                            maxlength="10" oninput="validatePhoneInput(this)">
                                        @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <script>
                                    function validatePhoneInput(input) {
                                        input.value = input.value.replace(/\D/g, '');
                                        input.value = input.value.replace(/^0+/, '');
                                        if (input.value.length > 10) {
                                            input.value = input.value.slice(0, 10);
                                        }
                                    }
                                </script>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email">Email :</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" id="email" value="{{ old('email') }}"
                                            autocomplete="off">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="state" class="star">State</label>
                                        <select id="state" class="form-control" name="state">
                                            <option value="">Select State</option>
                                            <option value="Andhra Pradesh"
                                                {{ old('state') == 'Andhra Pradesh' ? 'selected' : '' }}>Andhra Pradesh
                                            </option>
                                            <option value="Arunachal Pradesh"
                                                {{ old('state') == 'Arunachal Pradesh' ? 'selected' : '' }}>Arunachal
                                                Pradesh</option>
                                            <option value="Assam" {{ old('state') == 'Assam' ? 'selected' : '' }}>
                                                Assam</option>
                                            <option value="Bihar" {{ old('state') == 'Bihar' ? 'selected' : '' }}>
                                                Bihar</option>
                                            <option value="Chhattisgarh"
                                                {{ old('state') == 'Chhattisgarh' ? 'selected' : '' }}>Chhattisgarh
                                            </option>
                                            <option value="Goa" {{ old('state') == 'Goa' ? 'selected' : '' }}>Goa
                                            </option>
                                            <option value="Gujarat" {{ old('state') == 'Gujarat' ? 'selected' : '' }}>
                                                Gujarat</option>
                                            <option value="Haryana" {{ old('state') == 'Haryana' ? 'selected' : '' }}>
                                                Haryana</option>
                                            <option value="Himachal Pradesh"
                                                {{ old('state') == 'Himachal Pradesh' ? 'selected' : '' }}>Himachal
                                                Pradesh</option>
                                            <option value="Jharkhand"
                                                {{ old('state') == 'Jharkhand' ? 'selected' : '' }}>Jharkhand</option>
                                            <option value="Karnataka"
                                                {{ old('state') == 'Karnataka' ? 'selected' : '' }}>Karnataka</option>
                                            <option value="Kerala" {{ old('state') == 'Kerala' ? 'selected' : '' }}>
                                                Kerala</option>
                                            <option value="Madhya Pradesh"
                                                {{ old('state') == 'Madhya Pradesh' ? 'selected' : '' }}>Madhya Pradesh
                                            </option>
                                            <option value="Maharashtra"
                                                {{ old('state') == 'Maharashtra' ? 'selected' : '' }}>Maharashtra
                                            </option>
                                            <option value="Manipur" {{ old('state') == 'Manipur' ? 'selected' : '' }}>
                                                Manipur</option>
                                            <option value="Meghalaya"
                                                {{ old('state') == 'Meghalaya' ? 'selected' : '' }}>Meghalaya</option>
                                            <option value="Mizoram" {{ old('state') == 'Mizoram' ? 'selected' : '' }}>
                                                Mizoram</option>
                                            <option value="Nagaland"
                                                {{ old('state') == 'Nagaland' ? 'selected' : '' }}>Nagaland</option>
                                            <option value="Odisha" {{ old('state') == 'Odisha' ? 'selected' : '' }}>
                                                Odisha</option>
                                            <option value="Punjab" {{ old('state') == 'Punjab' ? 'selected' : '' }}>
                                                Punjab</option>
                                            <option value="Rajasthan"
                                                {{ old('state') == 'Rajasthan' ? 'selected' : '' }}>Rajasthan</option>
                                            <option value="Sikkim" {{ old('state') == 'Sikkim' ? 'selected' : '' }}>
                                                Sikkim</option>
                                            <option value="Tamil Nadu"
                                                {{ old('state') == 'Tamil Nadu' ? 'selected' : '' }}>Tamil Nadu
                                            </option>
                                            <option value="Telangana"
                                                {{ old('state') == 'Telangana' ? 'selected' : '' }}>Telangana</option>
                                            <option value="Tripura" {{ old('state') == 'Tripura' ? 'selected' : '' }}>
                                                Tripura</option>
                                            <option value="Uttar Pradesh"
                                                {{ old('state') == 'Uttar Pradesh' ? 'selected' : '' }}>Uttar Pradesh
                                            </option>
                                            <option value="Uttarakhand"
                                                {{ old('state') == 'Uttarakhand' ? 'selected' : '' }}>Uttarakhand
                                            </option>
                                            <option value="West Bengal"
                                                {{ old('state') == 'West Bengal' ? 'selected' : '' }}>West Bengal
                                            </option>
                                            <option value="Andaman and Nicobar Islands"
                                                {{ old('state') == 'Andaman and Nicobar Islands' ? 'selected' : '' }}>
                                                Andaman and Nicobar Islands</option>
                                            <option value="Chandigarh"
                                                {{ old('state') == 'Chandigarh' ? 'selected' : '' }}>Chandigarh
                                            </option>
                                            <option value="Dadra and Nagar Haveli and Daman and Diu"
                                                {{ old('state') == 'Dadra and Nagar Haveli and Daman and Diu' ? 'selected' : '' }}>
                                                Dadra and Nagar Haveli and Daman and Diu</option>
                                            <option value="Lakshadweep"
                                                {{ old('state') == 'Lakshadweep' ? 'selected' : '' }}>Lakshadweep
                                            </option>
                                            <option value="Delhi" {{ old('state') == 'Delhi' ? 'selected' : '' }}>
                                                Delhi</option>
                                            <option value="Puducherry"
                                                {{ old('state') == 'Puducherry' ? 'selected' : '' }}>Puducherry
                                            </option>
                                        </select>
                                        @if ($errors->has('state'))
                                            <span class="text-danger">{{ $errors->first('state') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="address">Address * :</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                                            autocomplete="off">{{ old('address') }}</textarea>
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <div class="mb-3">
                                        Want to add more Product → <a href="javascript:void(0);" id="addRow"
                                            class="btn btn-sm btn-primary">Add New Product</a>
                                    </div>
                                    <table id="dynamicTable" class="table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control select-product" name="product_id[]">
                                                        <option
                                                            data-src="https://cdn-icons-png.flaticon.com/128/5337/5337564.png"
                                                            disabled selected>Select Product</option>
                                                        @foreach ($units as $item)
                                                            <option value="{{ $item->id }}"
                                                                data-image="{{ $item->image }}"
                                                                data-stock="{{ $item->stock }}">
                                                                {{ $item->name }} - <b>STOCK:
                                                                    {{ $item->stock }}</b>
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control price-field"
                                                        name="price[]" value="">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control quantity-field"
                                                        name="quantity[]" placeholder="Enter Quantity" required>
                                                    <span class="error-message text-danger"
                                                        style="display: none;">Quantity exceeds available stock.</span>
                                                </td>
                                                <td>
                                                    <button
                                                        class="btn btn-danger waves-effect waves-light btn-xs delete-button">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <h3>Total Price: <span id="totalPrice">0.00</span></h3>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="discount" id="discount"
                                                placeholder="Discount in % only" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6"></div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_option">Payment Option * :</label>
                                        <select class="form-control @error('payment_option') is-invalid @enderror"
                                            name="payment_option" id="payment_option" required>
                                            <option disabled selected>Select Payment Option</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Card">Card</option>
                                            <option value="UPI">UPI</option>
                                        </select>
                                        @error('payment_option')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="form-group mb-0 mt-2">
                                <input type="submit" name="submit" id="save" class="btn btn-success"
                                    value="Submit Order">
                            </div>
                        </form>
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
        </div>
    </div>
</div>
<!-- Vendors JS -->
<script src="{{ asset('frontend/assets/js/vendor/vendor.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/plugins.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->
<!-- Main Activation JS -->
<script src="{{ asset('frontend/assets/js/main.js') }}"></script>
<script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
<script src="https://kit.fontawesome.com/18be827d01.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/metismenu"></script>
<script src="{{ asset('frontend/assets/js/intlTelInput.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sticky-sidebar/3.3.1/jquery.sticky-sidebar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        function formatState(state) {
            if (!state.id) {
                return state.text;
            }
            var imageUrl = 'https://openboxwale.in/public/uploads/products/' + $(state.element).data('image');
            console.log('Image URL:', imageUrl); // Debugging
            var $state = $(
                '<span><img src="' + imageUrl +
                '" class="img-flag" width="50" onerror="this.src=\'https://cdn-icons-png.flaticon.com/128/5337/5337564.png\'"/> ' +
                state.text + '</span>'
            );
            return $state;
        }

        function formatSelection(state) {
            if (!state.id) {
                return state.text;
            }
            var imageUrl = 'https://openboxwale.in/public/uploads/products/' + $(state.element).data('image');
            var $state = $(
                '<span><img src="' + imageUrl +
                '" class="img-flag" width="50" onerror="this.src=\'https://cdn-icons-png.flaticon.com/128/5337/5337564.png\'"/> ' +
                state.text + '</span>'
            );
            return $state;
        }

        $('.select-product').select2({
            placeholder: "Select a Product",
            allowClear: true,
            templateResult: formatState,
            templateSelection: formatSelection,
            escapeMarkup: function(m) {
                return m;
            }
        });

        // Function to update the total price 
        function updateTotalPrice() {
            let totalPrice = 0;
            $('#dynamicTable tbody tr').each(function() {
                let price = parseFloat($(this).find('.price-field').val()) || 0;
                let quantity = parseFloat($(this).find('input[name="quantity[]"]').val()) || 1;
                totalPrice += price * quantity;
            });
            // Apply discount if any 
            let discount = parseFloat($('#discount').val()) || 0;
            if (discount > 0) {
                totalPrice = totalPrice - (totalPrice * (discount / 100));
            }
            $('#totalPrice').text(totalPrice.toFixed(2));
        }

        // Add Row
        $('#addRow').click(function() {
            $('#dynamicTable tbody').append(`
                <tr>
                    <td>
                        <select class="form-control select-product" name="product_id[]">
                            <option data-src="https://cdn-icons-png.flaticon.com/128/5337/5337564.png" disabled selected>Select Product</option>
                            @foreach ($units as $item)
                                <option value="{{ $item->id }}" data-image="{{ $item->image }}" data-stock="{{ $item->stock }}">
                                    {{ $item->name }} - <b>STOCK: {{ $item->stock }}</b>
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control price-field" name="price[]" value="">
                    </td>
                    <td>
                        <input type="text" class="form-control quantity-field" name="quantity[]" placeholder="Enter Quantity" required>
                        <span class="error-message text-danger" style="display: none;">Quantity exceeds available stock.</span>
                    </td>
                    <td>
                        <button class="btn btn-danger waves-effect waves-light btn-xs delete-button">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);

            // Reinitialize Select2 for new rows
            $('.select-product').select2({
                placeholder: "Select a Product",
                allowClear: true,
                templateResult: formatState,
                templateSelection: formatSelection,
                escapeMarkup: function(m) {
                    return m;
                }
            });

            updateTotalPrice();
        });

        // Fetch price on product change
        $(document).on('change', '.select-product', function() {
            var productId = $(this).val();
            var priceField = $(this).closest('tr').find('.price-field');

            if (productId) {
                $.ajax({
                    url: "{{ url('get-product-price') }}",
                    data: {
                        productid: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    method: 'POST',
                    success: function(response) {
                        if (response.success) {
                            priceField.val(response.price);
                        } else {
                            priceField.val('');
                            alert('Failed to fetch price.');
                        }
                        updateTotalPrice();
                    },
                    error: function() {
                        priceField.val('');
                        alert('Error fetching price.');
                        updateTotalPrice();
                    }
                });
            } else {
                priceField.val('');
                updateTotalPrice();
            }
        });

        // Update total price when quantity changes 
        $(document).on('input', 'input[name="quantity[]"], .price-field', function() {
            updateTotalPrice();
        });

        // Also handle the change event for discount 
        $('#discount').on('change', function() {
            updateTotalPrice();
        });

        // Delete Row
        $(document).on('click', '.delete-button', function() {
            $(this).closest('tr').remove();
            updateTotalPrice();
        });
        updateTotalPrice();
    });
</script>
<style>
    .select2-container .select2-selection--single {
        height: 36px !important;
    }
</style>
@endsection