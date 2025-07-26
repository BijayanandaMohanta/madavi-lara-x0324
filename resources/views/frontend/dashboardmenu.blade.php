<div class="dashwidget">
    <div class="d-flex">
        <div class="prfimg"><img src="{{ asset('frontend/images/profileimg.jpg') }}" alt=""></div>
        <div class="prfcontent">
            <p>Hello</p>
            @php
                $customer = \App\Customer::find(Session::get('customer_id'));
            @endphp
            <h4>{{ $customer->name }}</h4>
        </div>
    </div>
</div>
<div class="dashwidget">
    <ul class="dashboard-menu">
        <li {{ Route::is('userprofile') ? 'class="active"' : '' }}><a href="{{ route('userprofile') }}"><object
                    data="{{ asset('frontend/images/dashboard/dashicon-1.svg') }}" type="image/svg+xml"></object> My
                Profile</a></li>
        <li {{ Route::is('userorders') ? 'class="active"' : '' }}><a href="{{ route('userorders') }}"><object
                    data="{{ asset('frontend/images/dashboard/dashicon-2.svg') }}" type="image/svg+xml"></object> My
                Orders</a></li>
        <li {{ Route::is('userwishlist') ? 'class="active"' : '' }}><a href="{{ route('userwishlist') }}"><object
                    data="{{ asset('frontend/images/dashboard/dashicon-3.svg') }}" type="image/svg+xml"></object> My
                Wishlist</a></li>
        <li {{ Route::is('useraddress') ? 'class="active"' : '' }}><a href="{{ route('useraddress') }}"><object
                    data="{{ asset('frontend/images/dashboard/dashicon-4.svg') }}" type="image/svg+xml"></object>
                Manage Address</a></li>
        <li {{ Route::is('userreviews') ? 'class="active"' : '' }}><a href="{{ route('userreviews') }}"><object
                    data="{{ asset('frontend/images/dashboard/dashicon-5.svg') }}" type="image/svg+xml"></object>
                Reviews & Ratings</a></li>
        <li {{ Route::is('userrewards') ? 'class="active"' : '' }}><a href="{{ route('userrewards') }}"><object
                    data="{{ asset('frontend/images/dashboard/dashicon-6.svg') }}" type="image/svg+xml"></object>
                Reward's Box</a></li>
        <li><a href="{{ route('contactus') }}"><object data="{{ asset('frontend/images/dashboard/dashicon-7.svg') }}"
                    type="image/svg+xml"></object> Contact Us</a></li>
        <li><a href="{{ route('userlogout') }}"><object data="{{ asset('frontend/images/dashboard/dashicon-8.svg') }}"
                    type="image/svg+xml"></object> Logout</a></li>
    </ul>
</div>
