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
                                    <a href="{{ route('useraddress') }}" class="dashnewaddr"><i
                                            class="fal fa-angle-left"></i>
                                        Back</a>
                                </div>
                                <h3>Manage Address</h3>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-x-12 col-lg-12 editaddrebox">
                            <div class="dashwidget px-0 mb-1">
                                <div class="card-body checkoutaddform">
                                    <h4>Edit Address</h4>
                                    <form action="{{ route('userupdateaddress') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value={{ $address->id }}>
                                        <div class="row">
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="" class="star">First Name</label>
                                                    <input type="text" class="form-control" name="first_name"
                                                        value="{{ old('first_name', $address->first_name) }}">
                                                    @if ($errors->has('first_name'))
                                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="star">Last Name</label>
                                                    <input type="text" class="form-control" name="last_name"
                                                        value="{{ old('last_name', $address->last_name) }}">
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
                                                    <input type="text" class="form-control" name="apartment"
                                                        value="{{ old('apartment', $address->apartment) }}">
                                                    @if ($errors->has('apartment'))
                                                        <span class="text-danger">{{ $errors->first('apartment') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="star">Street Address</label>
                                                    <input type="text" class="form-control" name="address"
                                                        value="{{ old('address', $address->address) }}">
                                                    @if ($errors->has('address'))
                                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="star">Landmark</label>
                                                    <input type="text" class="form-control" name="landmark"
                                                        value="{{ old('landmark', $address->landmark) }}">
                                                    @if ($errors->has('landmark'))
                                                        <span class="text-danger">{{ $errors->first('landmark') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="star">Town / City</label>
                                                    <input type="text" class="form-control" name="city"
                                                        value="{{ old('city', $address->city) }}">
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
                                                            {{ old('state', $address->state) == 'Andhra Pradesh' ? 'selected' : '' }}>
                                                            Andhra Pradesh</option>
                                                        <option value="Arunachal Pradesh"
                                                            {{ old('state', $address->state) == 'Arunachal Pradesh' ? 'selected' : '' }}>
                                                            Arunachal Pradesh</option>
                                                        <option value="Assam"
                                                            {{ old('state', $address->state) == 'Assam' ? 'selected' : '' }}>
                                                            Assam</option>
                                                        <option value="Bihar"
                                                            {{ old('state', $address->state) == 'Bihar' ? 'selected' : '' }}>
                                                            Bihar</option>
                                                        <option value="Chhattisgarh"
                                                            {{ old('state', $address->state) == 'Chhattisgarh' ? 'selected' : '' }}>
                                                            Chhattisgarh</option>
                                                        <option value="Goa"
                                                            {{ old('state', $address->state) == 'Goa' ? 'selected' : '' }}>
                                                            Goa</option>
                                                        <option value="Gujarat"
                                                            {{ old('state', $address->state) == 'Gujarat' ? 'selected' : '' }}>
                                                            Gujarat</option>
                                                        <option value="Haryana"
                                                            {{ old('state', $address->state) == 'Haryana' ? 'selected' : '' }}>
                                                            Haryana</option>
                                                        <option value="Himachal Pradesh"
                                                            {{ old('state', $address->state) == 'Himachal Pradesh' ? 'selected' : '' }}>
                                                            Himachal Pradesh</option>
                                                        <option value="Jharkhand"
                                                            {{ old('state', $address->state) == 'Jharkhand' ? 'selected' : '' }}>
                                                            Jharkhand</option>
                                                        <option value="Karnataka"
                                                            {{ old('state', $address->state) == 'Karnataka' ? 'selected' : '' }}>
                                                            Karnataka</option>
                                                        <option value="Kerala"
                                                            {{ old('state', $address->state) == 'Kerala' ? 'selected' : '' }}>
                                                            Kerala</option>
                                                        <option value="Madhya Pradesh"
                                                            {{ old('state', $address->state) == 'Madhya Pradesh' ? 'selected' : '' }}>
                                                            Madhya Pradesh</option>
                                                        <option value="Maharashtra"
                                                            {{ old('state', $address->state) == 'Maharashtra' ? 'selected' : '' }}>
                                                            Maharashtra</option>
                                                        <option value="Manipur"
                                                            {{ old('state', $address->state) == 'Manipur' ? 'selected' : '' }}>
                                                            Manipur</option>
                                                        <option value="Meghalaya"
                                                            {{ old('state', $address->state) == 'Meghalaya' ? 'selected' : '' }}>
                                                            Meghalaya</option>
                                                        <option value="Mizoram"
                                                            {{ old('state', $address->state) == 'Mizoram' ? 'selected' : '' }}>
                                                            Mizoram</option>
                                                        <option value="Nagaland"
                                                            {{ old('state', $address->state) == 'Nagaland' ? 'selected' : '' }}>
                                                            Nagaland</option>
                                                        <option value="Odisha"
                                                            {{ old('state', $address->state) == 'Odisha' ? 'selected' : '' }}>
                                                            Odisha</option>
                                                        <option value="Punjab"
                                                            {{ old('state', $address->state) == 'Punjab' ? 'selected' : '' }}>
                                                            Punjab</option>
                                                        <option value="Rajasthan"
                                                            {{ old('state', $address->state) == 'Rajasthan' ? 'selected' : '' }}>
                                                            Rajasthan</option>
                                                        <option value="Sikkim"
                                                            {{ old('state', $address->state) == 'Sikkim' ? 'selected' : '' }}>
                                                            Sikkim</option>
                                                        <option value="Tamil Nadu"
                                                            {{ old('state', $address->state) == 'Tamil Nadu' ? 'selected' : '' }}>
                                                            Tamil Nadu</option>
                                                        <option value="Telangana"
                                                            {{ old('state', $address->state) == 'Telangana' ? 'selected' : '' }}>
                                                            Telangana</option>
                                                        <option value="Tripura"
                                                            {{ old('state', $address->state) == 'Tripura' ? 'selected' : '' }}>
                                                            Tripura</option>
                                                        <option value="Uttar Pradesh"
                                                            {{ old('state', $address->state) == 'Uttar Pradesh' ? 'selected' : '' }}>
                                                            Uttar Pradesh</option>
                                                        <option value="Uttarakhand"
                                                            {{ old('state', $address->state) == 'Uttarakhand' ? 'selected' : '' }}>
                                                            Uttarakhand</option>
                                                        <option value="West Bengal"
                                                            {{ old('state', $address->state) == 'West Bengal' ? 'selected' : '' }}>
                                                            West Bengal</option>
                                                        <option value="Andaman and Nicobar Islands"
                                                            {{ old('state', $address->state) == 'Andaman and Nicobar Islands' ? 'selected' : '' }}>
                                                            Andaman and Nicobar Islands</option>
                                                        <option value="Chandigarh"
                                                            {{ old('state', $address->state) == 'Chandigarh' ? 'selected' : '' }}>
                                                            Chandigarh</option>
                                                        <option value="Dadra and Nagar Haveli and Daman and Diu"
                                                            {{ old('state', $address->state) == 'Dadra and Nagar Haveli and Daman and Diu' ? 'selected' : '' }}>
                                                            Dadra and Nagar Haveli and Daman and Diu</option>
                                                        <option value="Lakshadweep"
                                                            {{ old('state', $address->state) == 'Lakshadweep' ? 'selected' : '' }}>
                                                            Lakshadweep</option>
                                                        <option value="Delhi"
                                                            {{ old('state', $address->state) == 'Delhi' ? 'selected' : '' }}>
                                                            Delhi</option>
                                                        <option value="Puducherry"
                                                            {{ old('state', $address->state) == 'Puducherry' ? 'selected' : '' }}>
                                                            Puducherry</option>
                                                    </select>
                                                    @if ($errors->has('state'))
                                                        <span class="text-danger">{{ $errors->first('state') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="star">Zip</label>
                                                    <input type="text" class="form-control" name="pincode"
                                                        value="{{ old('pincode', $address->pincode) }}">
                                                    @if ($errors->has('pincode'))
                                                        <span class="text-danger">{{ $errors->first('pincode') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="star">Phone</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        value="{{ old('phone', $address->phone) }}">
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
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ old('email', $address->email) }}">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                <div class="d-flex">
                                                    <label class="control control--radio">Home
                                                        <input type="radio" name="type" value="Home"
                                                            {{ old('type', $address->type) == 'Home' ? 'checked' : '' }} />
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                    <label class="control control--radio">Work
                                                        <input type="radio" name="type" value="Work"
                                                            {{ old('type', $address->type) == 'Work' ? 'checked' : '' }} />
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                    <label class="control control--radio">Others
                                                        <input type="radio" name="type" value="Others"
                                                            {{ old('type', $address->type) == 'Others' ? 'checked' : '' }} />
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                    @if ($errors->has('type'))
                                                        <span class="text-danger">{{ $errors->first('type') }}</span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn-saveaddress">Save Address</button>
                                                </div>
                                            </div>
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
@endsection
