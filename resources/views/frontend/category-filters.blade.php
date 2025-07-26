<div class="shop-sidebar-wrap">
    <div class="sidebar-widget">
        <h3 class="sidebar-title">Browse Categories</h3>
        @php
            $categories = App\Category::select(['id', 'category', 'slug'])
                ->with(['subcategories.products'])
                ->get();
            // dd($categories);
        @endphp
        <div class="accordion" id="accordionExample">
            @foreach ($categories->sortBy('category') as $index => $item)
                <div class="card">
                    <div class="card-header" id="heading{{ $index }}">
                        <a href="#" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                            aria-expanded="false" aria-controls="collapse{{ $index }}" class="collapsed"></a>
                        <span onClick="location.href='{{ route('categorylist', $item->slug ?? 'default') }}'"
                            class="ps-3 fw-600">{{ $item->category }}</span>
                    </div>

                    <div id="collapse{{ $index }}" class="collapse" aria-labelledby="heading{{ $index }}"
                        data-parent="#accordionExample" style="">
                        <div class="card-body">
                            <ul class="category-list">
                                @foreach ($item->subcategories as $subIndex => $subcategory)
                                    @php
                                        // dd($subcategory);
                                        $childcategories = \App\Ccategory::where('category_id', $item->id)
                                            ->where('sub_category_id', $subcategory->id)
                                            ->where('status', 1)
                                            ->get();
                                    @endphp
                                    <li>
                                        <a href="#" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSub{{ $index }}{{ $subIndex }}"
                                            aria-expanded="false"
                                            aria-controls="collapseSub{{ $index }}{{ $subIndex }}"
                                            class="collapsed" style="display:inline">
                                            @if ($childcategories->isNotEmpty())
                                                <i class="fas fa-chevron-right"></i>
                                            @endif
                                        </a>
                                        <span
                                            onClick="location.href='{{ route('subcategorylist', $subcategory->slug ?? 'default') }}'"
                                            class="fz-12 ps-2">{{ $subcategory->category }}
                                            ({{ $subcategory->products->count() }})
                                        </span>

                                        <div id="collapseSub{{ $index }}{{ $subIndex }}" class="collapse"
                                            aria-labelledby="heading{{ $index }}{{ $subIndex }}"
                                            data-parent="#collapse{{ $index }}" style="margin-left: 15px;">
                                            <ul class="subcategory-list">
                                                @foreach ($childcategories as $childCategory)
                                                    <li>
                                                        <a
                                                            href="{{ route('childcategorylist', $childCategory->slug ?? 'default') }}">

                                                            <span class="fz-12"> {{ $childCategory->category }}
                                                                ({{ $childCategory->products->count() }})
                                                            </span> </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div> <!-- card -->
            @endforeach

        </div>
    </div>
    <style>
        .category-list i {
            font-size: 11px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach a click event listener to each collapse toggle link
            document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(function(collapseToggle) {
                collapseToggle.addEventListener('click', function() {
                    var icon = this.querySelector('i.fas');
                    var isExpanded = this.getAttribute('aria-expanded') === 'true';
                    if (isExpanded) {
                        icon.classList.add('fa-chevron-down');
                        icon.classList.remove('fa-chevron-right');
                    } else {
                        icon.classList.add('fa-chevron-right');
                        icon.classList.remove('fa-chevron-down');
                    }
                });

                // Trigger the click event initially to set the correct icon
                // collapseToggle.click();
            });
        });
    </script>

    <!-- Sidebar single item -->
    @if (Route::currentRouteName() !== 'shopbybrandlist')

        <div class="sidebar-widget">
            <h3 class="sidebar-title">Filters</h3>
            <!-- Sidebar single item -->
            <div class="filter-sec">
                <h5 class="pro-sidebar-title">Brands</h5>
                <div class="sidebar-widget-list">
                    @php

                    @endphp
                    <ul>
                        @php
                            if (isset($category)) {
                                $brands = $category->uniqueBrands();
                            } else {
                                $allBrands = [];
                                foreach ($offerproducts ?? ($products_data ?? $products) as $product) {
                                    $brands = explode(',', $product->brand);
                                    // die("here");
                                    $allBrands = array_merge($allBrands, $brands);
                                }
                                $brands = array_unique($allBrands);
                            }
                            $brands = $brands ?? App\Brand::select(['brand'])->get();
                            sort($brands);
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
    @endif

    <!-- Sidebar single item -->
    <div class="sidebar-widget">
        <h3 class="sidebar-title">Price</h3>
        <!-- Sidebar single item -->
        <div class="price-filter mt-10">
            <div class="slider-container w-100">
                <div id="slider" class="range-slider"></div>
                <div class="slider-values d-flex justify-content-between">
                    <input type="number" id="min-value" value="0" min="0" max="99999">
                    <div>to</div>
                    <input type="number" id="max-value" value="99999" min="0" max="99999">
                </div>
                <div class="d-flex mt-3">
                    <div class="btn btn-light border rounded-pill" id='resetfilter'>Reset Filters</div>
                    <div class="btn btn-light border rounded-pill" id='pricefilter'>Go</div>
                </div>
            </div>
        </div>
        <!-- Sidebar single item -->
    </div>
    <script>
        document.getElementById('resetfilter').addEventListener('click', function() {
            // Get the base URL without query parameters
            const baseUrl = window.location.origin + window.location.pathname;

            // Redirect to the base URL
            window.location.href = baseUrl;
        });
    </script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);

        // Extract the min and max price values from the URL parameters
        const minPrice = parseInt(urlParams.get('min_price'), 10) || 0;
        const maxPrice = parseInt(urlParams.get('max_price'), 10) || 24990;

        // Update the slider and input fields
        document.getElementById('min-value').value = minPrice;
        document.getElementById('max-value').value = maxPrice;

        // Assuming you're using a library like noUiSlider for the slider:
        slider.noUiSlider.updateOptions({
            range: {
                min: minPrice,
                max: maxPrice
            },
            start: [minPrice, maxPrice]
        });
    </script>
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
<script>
    $(document).ready(function() {
        $('#pricefilter').click(function() {
            var minValue = $('#min-value').val();
            var maxValue = $('#max-value').val();

            var url = new URL(window.location.href);
            url.searchParams.set('min_price', minValue);
            url.searchParams.set('max_price', maxValue);

            var brandsParam = url.searchParams.get('brands');

            if (brandsParam) {
                var selectedBrands = [];
                $('.brand-checkbox:checked').each(function() {
                    selectedBrands.push($(this).val());
                });

                var newBrandQuery = selectedBrands.join(',');

                if (newBrandQuery !== brandsParam) {
                    url.searchParams.set('brands', newBrandQuery);
                }
            }

            window.location.href = url.toString();
        });
    });
</script>
