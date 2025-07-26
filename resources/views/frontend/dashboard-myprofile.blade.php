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
                            <h3>My Profile</h3>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-x-12 col-lg-12">
                        <div class="dashwidget">
                            <div class="row justify-content-center">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-10 py-5">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('updateprofile') }}" method="post" id="loginFormEmail">
                                        @csrf
                                        <div class="row dashboard-forms">
                                            <!-- Full Name Field -->
                                            <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Full Name</label>
                                                    <span><a href="#" class="edit-link" data-target="name">Edit</a></span>
                                                    <input type="text" name="name" class="form-control" value="{{ $customer->name }}" readonly>
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                    
                                            <!-- Mobile Field -->
                                            <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Mobile No.</label>
                                                    <span><a href="#" class="edit-link" data-target="mobile"></a></span>
                                                    <input type="text" name="mobile" class="form-control" value="{{ $customer->mobile }}" readonly>
                                                    @if ($errors->has('mobile'))
                                                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                    
                                            <!-- Email Field -->
                                            <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <span><a href="#" class="edit-link" data-target="email"></a></span>
                                                    <input type="email" name="email" class="form-control" value="{{ $customer->email }}" readonly>
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                    
                                            <!-- Password Field -->
                                            <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                <div class="form-group position-relative">
                                                    <label for="">Password</label>
                                                    <span><a href="#" class="edit-link" data-target="password">Edit</a></span>
                                                    <input type="password" name="password" class="form-control" id="password" value="" minlength="8" readonly>
                                                    <span toggle="#password" class="far fa-fw fa-eye-slash field-icon toggle-password" style="cursor:pointer;"></span>
                                                </div>
                                            </div>
                                    
                                            <!-- Buttons -->
                                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                <div class="form-group d-flex">
                                                    <button type="submit" class="btn-submit">Update</button>
                                                    {{-- <button type="button" class="btn-cancel ms-2">Cancel</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                    <!-- JavaScript to Toggle Edit -->
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            // Track editable fields
                                            const editableFields = {
                                                mobile: false,
                                                email: false
                                            };
                                    
                                            // Add click event listeners to all "Edit" links
                                            document.querySelectorAll('.edit-link').forEach(function (editLink) {
                                                editLink.addEventListener('click', function (e) {
                                                    e.preventDefault(); // Prevent the default link behavior
                                    
                                                    // Get the target input field
                                                    const target = this.getAttribute('data-target');
                                                    const inputField = document.querySelector(`input[name="${target}"]`);
                                    
                                                    // Toggle the readonly attribute
                                                    if (inputField.hasAttribute('readonly')) {
                                                        inputField.removeAttribute('readonly');
                                                        inputField.focus(); // Focus on the input field for better UX
                                                        editableFields[target] = true; // Mark the field as editable
                                                    } else {
                                                        inputField.setAttribute('readonly', true);
                                                        editableFields[target] = false; // Mark the field as non-editable
                                                    }
                                                });
                                            });
                                    
                                            // Handle form submission
                                            document.getElementById('loginFormEmail').addEventListener('submit', function (e) {
                                                // Disable non-editable fields before submission
                                                if (!editableFields.mobile) {
                                                    document.querySelector('input[name="mobile"]').disabled = true;
                                                }
                                                if (!editableFields.email) {
                                                    document.querySelector('input[name="email"]').disabled = true;
                                                }
                                            });
                                        });
                                    </script>
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
<script>
    var loginValidator = $('#loginFormEmail').validate({
        rules: {

          
            password: {
                minlength: 8
            }
        },
        messages: {

            email: {
                required: 'email is required',
                email: 'email must be valid'
            },
            password: {
                required: 'password is required',
                minlength: 'Password must be at least 8 characters'
            }
        }
    });
</script>

@endsection