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
                                <h3>Reviews & Rating</h3>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-x-12 col-lg-12">
                            <div class="dashwidget px-0 wishlistbox">
                                @forelse ($reviews as $review)
                                    <div class="orddetailsbox">
                                        <div class="row">
                                            <div class="col-xxl-12 col-xl-12 col-lg-12">
                                                <div class="itemdetailsrow pe-0">
                                                    <div class="itemproduct pe-0">
                                                        <div class="itemimg">
                                                            @php
                                                                $product_id = $review->product->id;
                                                                $product_image = \App\ProductImage::where('product_id', $product_id)->orderBy('priority', 'asc')->first();
                                                            @endphp
                                                            <img src="{{ asset("uploads/products/$product_image->image") }}"
                                                                alt="{{ $review->product->name }}">
                                                        </div>
                                                        <div class="itemtitle">
                                                            <a href="{{ route('product', $review->product->slug) }}">
                                                                {{ $review->product->name }}
                                                            </a>
                                                            <div class="rating-section dhseditreviewbox">
                                                                <a href="#ratingsreviewsModal" data-product-id ="{{$review->product->id}}" data-bs-toggle="modal" data-comment="{{$review->review}}"  data-rating="{{$review->rating}}" class="revewedit"><i class="fa fa-edit"></i></a>
                                                                <div class="review border-0">
                                                                    <div class="stars">
                                                                        <span
                                                                            class="black fw-600">{{ $review->rating }}</span>
                                                                        @php
                                                                            $i = 1;
                                                                        @endphp
                                                                        
                                                                        @while ($i <= 5)
                                                                            @if ($i <= $review->rating)
                                                                                <i class="fa fa-star"></i>
                                                                            @else
                                                                                <i class="fa fa-star grey"></i>
                                                                            @endif
                                                                            @php
                                                                                $i++;
                                                                            @endphp
                                                                        @endwhile
                                                                        


                                                                        {{-- <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i>
                                                                        <i class="fa fa-star grey"></i> --}}
                                                                    </div>
                                                                    <div class="comment">{{ $review->review }}</div>

                                                                    <div class="name">{{ $review->name }}- <span>
                                                                            {{ \Carbon\Carbon::parse($review->updated_at)->format('F j, Y') }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <p>No data found.</p>
                                        </div>
                                    </div>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- review and ratings Modal -->
    <div class="modal fade" id="ratingsreviewsModal" tabindex="-1" aria-labelledby="ratingsreviewsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h4 class="modal-title fs-5" id="changeaddressModalLabel">Ratings & Reviews</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fal fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body p-0">
                    <form id="reviewUpdateForm" action="{{ route('rating_update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{Session::get('customer_id')}}">
                        <input type="hidden" name="product_id" id="product_id" value="">
                        <div class="row">
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                                <div class="form-group p-4 pb-0">
                                    <label for="">Rate this product</label>
                                </div>
                                <div class="form-group p-4 pb-0" style="width: fit-content;">
                                    <div class="reviewratingboxnew">
                                        <input type="radio" name="rating" id="rating-1" value="5"><label
                                            for="rating-1"></label>
                                        <input type="radio" name="rating" id="rating-2" value="4"><label
                                            for="rating-2"></label>
                                        <input type="radio" name="rating" id="rating-3" value="3"><label
                                            for="rating-3"></label>
                                        <input type="radio" name="rating" id="rating-4" value="2"><label
                                            for="rating-4"></label>
                                        <input type="radio" name="rating" id="rating-5" value="1"><label
                                            for="rating-5"></label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group p-4 pt-2">
                                    <label for="">Review this product</label>
                                    <textarea name="review" id="review" rows="5" class="form-control" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group pb-4 px-4">
                                    <button type="button" class="btn btn-primary" id="submitUpdateReview">Update Review</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .reviewratingboxnew {
            display: flex;
            flex-direction: row-reverse;
        }

        .reviewratingboxnew input {
            display: none;
        }

        /* when label hover I want the label:before color should change */
        .reviewratingboxnew label:hover:before {
            color: orange;
        }

        /* when hover the left side all star before color should change */
        .reviewratingboxnew label:hover~label:before {
            color: orange;
        }

        /* this is changing the after stars but I want before stars */
        .reviewratingboxnew input:checked~label:before {
            color: orange;
        }
    </style>

    <script>
        const productidFormElement = document.getElementById('product_id');
        const reviewFormElement = document.getElementById('review');
        Array.from(document.getElementsByClassName('revewedit')).forEach(button => {
            button.addEventListener('click', () => {
                const product_id = button.getAttribute('data-product-id');
                const comment = button.dataset.comment;
                const rating = button.dataset.rating;
                productidFormElement.value = product_id;
                reviewFormElement.value = comment;
                const radioButton = document.querySelector(`input[name="rating"][value="${rating}"]`);
                if (radioButton) {
                    radioButton.checked = true;
                }
            });
        });
    </script>

   
@endsection
