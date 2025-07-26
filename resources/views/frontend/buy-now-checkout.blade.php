@extends('frontend.layouts.main')
@section('content')
        <div class="breadcrumb-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-content">
                            <ul class="nav">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12">
                <h3 class="subpagetitle">Checkout</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-8 col-xl-8 col-lg-8 cartitemsbox">
                <div class="card">
                    <div class="card-body checkoutaddform">
                        <h4>Delivery Address</h4>
                        <form action="{{ route('cart_address_submit') }}" method="POST" name="address">
                                    @csrf
                                    <input type="hidden" name="buy_now" value="buy_now">
                            <div class="row">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="" class="star">First Name</label>
                                        <input type="text" name="first_name" class="form-control"
                                            placeholder="Your Name" value="{{ old('first_name') }}">
                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="" class="star">Last Name</label>
                                        <input type="text" name="last_name" class="form-control"
                                            placeholder="Last Name" value="{{ old('last_name') }}">
                                        @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        const nameFields = document.querySelectorAll('input[name="first_name"], input[name="last_name"]');

                                        nameFields.forEach((field) => {
                                            field.addEventListener("input", (event) => {
                                                const value = field.value;
                                                // Allow only letters and spaces
                                                const validValue = value.replace(/[^a-zA-Z\s]/g, "");
                                                if (value !== validValue) {
                                                    field.value = validValue;
                                                }
                                            });
                                        });
                                    });
                                </script>

                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="">Apartment, suite, unit, etc.</label>
                                        <input type="text" name="apartment" class="form-control"
                                            placeholder="Apartment, suite, unit, etc." value="{{ old('apartment') }}">
                                        @if ($errors->has('apartment'))
                                            <span class="text-danger">{{ $errors->first('apartment') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="" class="star">Street Address</label>
                                        <input type="text" name="address" class="form-control"
                                            placeholder="Street Address" value="{{ old('address') }}">
                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="" class="star">Landmark</label>
                                            <input type="text" name="landmark" class="form-control"
                                                placeholder="Landmark" value="{{ old('landmark') }}">
                                            @if ($errors->has('landmark'))
                                                <span class="text-danger">{{ $errors->first('landmark') }}</span>
                                            @endif
                                        </div>
                                    </div>


                                

                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="" class="star">Town / City</label>
                                        <input type="text" name="city" class="form-control"
                                            placeholder="Town / City" value="{{ old('city') }}">
                                        @if ($errors->has('city'))
                                            <span class="text-danger">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="state" class="star">State</label>
                                        <select id="state" class="form-control" name="state">
                                            <option value="">Select State</option>
                                            <option value="Andhra Pradesh"
                                                {{ old('state') == 'Andhra Pradesh' ? 'selected' : '' }}>Andhra
                                                Pradesh</option>
                                            <option value="Arunachal Pradesh"
                                                {{ old('state') == 'Arunachal Pradesh' ? 'selected' : '' }}>
                                                Arunachal Pradesh</option>
                                            <option value="Assam" {{ old('state') == 'Assam' ? 'selected' : '' }}>
                                                Assam</option>
                                            <option value="Bihar" {{ old('state') == 'Bihar' ? 'selected' : '' }}>
                                                Bihar</option>
                                            <option value="Chhattisgarh"
                                                {{ old('state') == 'Chhattisgarh' ? 'selected' : '' }}>
                                                Chhattisgarh</option>
                                            <option value="Goa" {{ old('state') == 'Goa' ? 'selected' : '' }}>Goa
                                            </option>
                                            <option value="Gujarat" {{ old('state') == 'Gujarat' ? 'selected' : '' }}>
                                                Gujarat
                                            </option>
                                            <option value="Haryana" {{ old('state') == 'Haryana' ? 'selected' : '' }}>
                                                Haryana
                                            </option>
                                            <option value="Himachal Pradesh"
                                                {{ old('state') == 'Himachal Pradesh' ? 'selected' : '' }}>
                                                Himachal Pradesh</option>
                                            <option value="Jharkhand"
                                                {{ old('state') == 'Jharkhand' ? 'selected' : '' }}>Jharkhand
                                            </option>
                                            <option value="Karnataka"
                                                {{ old('state') == 'Karnataka' ? 'selected' : '' }}>Karnataka
                                            </option>
                                            <option value="Kerala" {{ old('state') == 'Kerala' ? 'selected' : '' }}>
                                                Kerala
                                            </option>
                                            <option value="Madhya Pradesh"
                                                {{ old('state') == 'Madhya Pradesh' ? 'selected' : '' }}>Madhya
                                                Pradesh</option>
                                            <option value="Maharashtra"
                                                {{ old('state') == 'Maharashtra' ? 'selected' : '' }}>
                                                Maharashtra</option>
                                            <option value="Manipur" {{ old('state') == 'Manipur' ? 'selected' : '' }}>
                                                Manipur
                                            </option>
                                            <option value="Meghalaya"
                                                {{ old('state') == 'Meghalaya' ? 'selected' : '' }}>Meghalaya
                                            </option>
                                            <option value="Mizoram" {{ old('state') == 'Mizoram' ? 'selected' : '' }}>
                                                Mizoram
                                            </option>
                                            <option value="Nagaland"
                                                {{ old('state') == 'Nagaland' ? 'selected' : '' }}>Nagaland
                                            </option>
                                            <option value="Odisha" {{ old('state') == 'Odisha' ? 'selected' : '' }}>
                                                Odisha
                                            </option>
                                            <option value="Punjab" {{ old('state') == 'Punjab' ? 'selected' : '' }}>
                                                Punjab
                                            </option>
                                            <option value="Rajasthan"
                                                {{ old('state') == 'Rajasthan' ? 'selected' : '' }}>Rajasthan
                                            </option>
                                            <option value="Sikkim" {{ old('state') == 'Sikkim' ? 'selected' : '' }}>
                                                Sikkim
                                            </option>
                                            <option value="Tamil Nadu"
                                                {{ old('state') == 'Tamil Nadu' ? 'selected' : '' }}>Tamil Nadu
                                            </option>
                                            <option value="Telangana"
                                                {{ old('state') == 'Telangana' ? 'selected' : '' }}>Telangana
                                            </option>
                                            <option value="Tripura" {{ old('state') == 'Tripura' ? 'selected' : '' }}>
                                                Tripura
                                            </option>
                                            <option value="Uttar Pradesh"
                                                {{ old('state') == 'Uttar Pradesh' ? 'selected' : '' }}>Uttar
                                                Pradesh</option>
                                            <option value="Uttarakhand"
                                                {{ old('state') == 'Uttarakhand' ? 'selected' : '' }}>
                                                Uttarakhand</option>
                                            <option value="West Bengal"
                                                {{ old('state') == 'West Bengal' ? 'selected' : '' }}>West
                                                Bengal</option>
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
                                                {{ old('state') == 'Lakshadweep' ? 'selected' : '' }}>
                                                Lakshadweep</option>
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

                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="" class="star">Zip</label>
                                        <input type="text" name="pincode" class="form-control" placeholder="Zip"
                                            value="{{ old('pincode') }}" maxlength="6">
                                        @if ($errors->has('pincode'))
                                            <span class="text-danger">{{ $errors->first('pincode') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="" class="star">Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Phone" value="{{ old('phone') }}" maxlength="10">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        const fields = {
                                            pincode: {
                                                field: document.querySelector('input[name="pincode"]'),
                                                length: 6
                                            },
                                            phone: {
                                                field: document.querySelector('input[name="phone"]'),
                                                length: 10
                                            }
                                        };

                                        Object.keys(fields).forEach(key => {
                                            const {
                                                field,
                                                length
                                            } = fields[key];

                                            field.addEventListener("input", (event) => {
                                                // Allow only numbers
                                                field.value = field.value.replace(/[^0-9]/g, "");

                                                // Limit input to the specified length
                                                if (field.value.length > length) {
                                                    field.value = field.value.slice(0, length);
                                                }
                                            });

                                        });
                                    });
                                </script>


                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="" class="star">Email Address</label>
                                        <input type="text" name="email" class="form-control"
                                            placeholder="Email Address" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Order notes (optional)</label>
                                        <textarea name="order_note" id="" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                    <div class="d-flex">
                                        <label class="control control--radio">Home
                                            <input type="radio" name="type" value="Home"
                                                {{ old('type') == 'Home' ? 'checked' : '' }} />
                                            <div class="control__indicator"></div>
                                        </label>
                                        <label class="control control--radio">Work
                                            <input type="radio" name="type" value="Work"
                                                {{ old('type') == 'Work' ? 'checked' : '' }} />
                                            <div class="control__indicator"></div>
                                        </label>
                                        <label class="control control--radio">Others
                                            <input type="radio" name="type" value="Others"
                                                {{ old('type') == 'Others' ? 'checked' : '' }} />
                                            <div class="control__indicator"></div>
                                        </label>
                                        @if ($errors->has('type'))
                                            <span class="text-danger">{{ $errors->first('type') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xxl-12 col-xl-12 col-lg-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn-saveaddress">Save Address</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4">
                <div class="card mb-4 crttotals">
                    <div class="card-body">
                    <table class="table cartotals">
                        <tr>
                            <td>Total Products ({{ $carts->total_quantity }})</td>
                            <td>Rs. {{ $carts->cart_total }} @if($carts->cart_total > 399) <span>Free Shipping</span> @endif</td>
                        </tr>
                        <tr>
                            <td>Sub Total</td>
                            <td>Rs. {{ $carts->cart_total }}</td>
                        </tr>
                        <tr>
                            <td>Coupon code Discount</td>
                            <td>Rs. 0</td>
                        </tr>
                        <tr>
                            <td>Shipping Charges</td>
                            <td>Rs. 0</td>
                        </tr>
                        <tr>
                            <td class="border-0 pb-0">Grand Total</td>
                            <td class="border-0 pb-0">Rs. {{ $carts->cart_total }}</td>
                        </tr>
                        <tr>
                            <td class="border-0">Savings</td>
                            <td class="border-0">Rs. {{ round($carts->saving)}}</td>
                        </tr>
                    </table>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@if ($bestsellingproducts->isNotEmpty())
        <!--NEW ARRIVAL START-->
        <div class="feature-area mt-60px mb-30px">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-12">
                        <div class="arrival-section">
                            <div class="new-arrival">
                                <h3>BEST
                                    <span> SELLER'S</span>
                                </h3>
                            </div>
                            <!-- Add Arrows -->
                        </div>
                    </div>
                    <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-12">
                        <div class="center slider feature-slider-two new-arrivals">
                            @foreach ($bestsellingproducts as $product)
                                <div>
                                    <div class="feature-slider-item">
                                        <div class="new-arrive">
                                            <div class="arrival-brand">
                                                <small>{{ $product->brand }}</small>
                                            </div>
                                            <div class="arrival-quantity">
                                                <small>{{ $product->stock }} in Stock</small>
                                            </div>
                                        </div>
                                        <div class="arrival-text">
                                            <a href="{{ route('product', $product->slug) }}">{{ $product->name }}</a>
                                        </div>
                                        <div class="arrival-image">
                                            <a href="{{ route('product', $product->slug) }}">
                                                @if ($product->image != 'no-image')
                                                    <img src="{{ asset("uploads/products/$product->image") }}"
                                                        alt="{{ $product->name }}">
                                                @else
                                                    <img src="https://placehold.co/400x400?text=No+Image+Found!"
                                                        alt="Default Image">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="arrival-members">
                                            <div class="arrival-ratings1">
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                            </div>
                                            <div class="rating-members">
                                                <small>20 REVIEWS</small>
                                            </div>
                                        </div>
                                        <div class="arrival-price">
                                            <h4>Rs.{{ $product->price }}</h4>
                                            <h5>Rs.{{ $product->mop }}</h5>
                                        </div>
                                        <div class="arrival-buttons d-flex justify-content-between">
                                            <a href="#" class="add-cart-btn">Add to cart</a>
                                            <a href="{{ route('product', $product->slug) }}" class="buy-now-btn">Buy
                                                now</a>
                                        </div>
                                        @php
                                            $price = $product->price;
                                            $mrp = $product->mop;

                                            // Calculate percentage off
                                            $percentageOff = $mrp > 0 ? (($mrp - $price) / $mrp) * 100 : 0;
                                        @endphp
                                        @if ($percentageOff >= 1)
                                            <div class="arrival-offer">
                                                <h6>{{ round($percentageOff) }}%</h6>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection