<!-- Brand area start -->
<div class="brand-area mb-30px">
    <div class="container-fluid">
        <div class="center brand-slider slider">
            @php
                $brands = \App\Brand::where('status',1)->limit(20)->get();
            @endphp
            @foreach ($brands as $brand)
            <div>
                <div class="brand-slider-item">
                    <a href="{{route('shopbybrandlist',$brand->slug)}}"><img src="https://images.weserv.nl/?url={{asset("uploads/brand/$brand->image")}}&w=200&h=200" alt="{{$brand->brand}}"></a>
                </div>
            </div>
            @endforeach
            
            
        </div>
    </div>
</div>
<!-- Brand area end -->