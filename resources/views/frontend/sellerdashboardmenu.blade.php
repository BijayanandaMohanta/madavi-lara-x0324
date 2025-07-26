<div class="dashwidget">
    <div class="d-flex">
        <div class="prfimg"><img src="{{ asset('frontend/images/profileimg.jpg') }}" alt=""></div>
        <div class="prfcontent">
            <p>Hello</p>
            @php
                $seller = \App\Seller::find(Session::get('seller_id'));
            @endphp
            <h4>{{ $seller->name }}</h4>
        </div>
    </div>
</div>
<div class="dashwidget">
    <ul class="dashboard-menu">
        <li><a href=""><object data="{{ asset('frontend/images/dashboard/dashicon-2.svg') }}"
                    type="image/svg+xml"></object>Orders</a></li>
        <li><a href="{{ route('sellerlogout') }}"><object data="{{ asset('frontend/images/dashboard/dashicon-8.svg') }}"
                    type="image/svg+xml"></object> Logout</a></li>
    </ul>
</div>
