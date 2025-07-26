<div class="shop-sidebar-wrap">
    <!-- Sidebar single item -->
    <div class="sidebar-widget">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="sidebar-title">Filters</h3>
                      
            <a href="{{ route('brandproductlistfilter', ['brands' => request()->get('brands')]) }}" class="btn btn-sm btn-light border rounded-pill me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to search products with the selected brands">Search Products</a>

            {{-- <script>
            $(document).ready(function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });
            </script> --}}
        </div>
        <!-- Sidebar single item -->
        <div class="filter-sec">
            <h5 class="pro-sidebar-title">Brands</h5>
            <div class="sidebar-widget-list">
                @php
                    // echo $_GET["brand"];
                @endphp
                <ul>
                    @php
                        $brands = App\Brand::all()->pluck('brand');
                        // dd($brands);
                        // sort($brands);
                    @endphp
                    @foreach ($brands as $index => $brand)
                        @if ($brand != '')
                            <li>
                                <div class="sidebar-widget-list-left">
                                    <input type="checkbox" id="brand-{{ $index }}" class="brand-checkbox"
                                        value="{{ $brand }}" />
                                    <label for="brand-{{ $index }}">
                                        {{ $brand }}
                                    </label>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Sidebar single item -->
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Pre-check checkboxes based on URL parameters
        var urlParams = new URLSearchParams(window.location.search);
        var brandsParam = urlParams.get('brands');
        if (brandsParam) {
            var selectedBrands = brandsParam.split(',');
            $('.brand-checkbox').each(function() {
                if (selectedBrands.includes($(this).val())) {
                    $(this).prop('checked', true);
                }
            });
        }

        // Update URL on checkbox change
        $('.brand-checkbox').change(function() {
            var selectedBrands = [];
            $('.brand-checkbox:checked').each(function() {
                selectedBrands.push($(this).val());
            });

            var newBrandQuery = selectedBrands.join(',');

            if (brandsParam) {
                var existingBrandsArray = brandsParam.split(',');

                // Add or remove brand from the URL based on its presence
                var checkboxValue = $(this).val();
                if ($(this).prop('checked')) {
                    if (!existingBrandsArray.includes(checkboxValue)) {
                        existingBrandsArray.push(checkboxValue);
                    }
                } else {
                    var index = existingBrandsArray.indexOf(checkboxValue);
                    if (index !== -1) {
                        existingBrandsArray.splice(index, 1);
                    }
                }

                newBrandQuery = existingBrandsArray.join(',');
            }

            urlParams.set('brands', newBrandQuery);
            window.location.search = urlParams.toString();
        });
    });
</script>
