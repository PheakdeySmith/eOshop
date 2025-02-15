@extends('frontend.master')
@section('content')

    {{-- filter-categories --}}
    @include('frontend.partials.shopping.filter-categories')

    {{-- filter-card --}}
    <section class="overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                {{-- Filter card (3 columns) --}}
                @include('frontend.partials.shopping.filter-card')

                {{-- Product section (9 columns) --}}
                @include('frontend.partials.shopping.product-section')

                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header d-flex flex-wrap justify-content-end mb-5">
                            <div class="d-flex align-items-center">
                                <!-- "View More Products" Link -->
                                <a href="#" class="btn-link text-decoration-none" onclick="goToNextPage()">View More Products →</a>
                                <div class="swiper-buttons">
                                    <!-- Previous Button -->
                                    <button class="swiper-prev product-carousel-prev btn btn-yellow" onclick="goToPreviousPage()">❮</button>

                                    <!-- Page Number Display -->
                                    <span class="mx-3">Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>

                                    <!-- Next Button -->
                                    <button class="swiper-next product-carousel-next btn btn-yellow" onclick="goToNextPage()">❯</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- section 11 - Mobile App --}}
    @include('frontend.partials.section_11')

    {{-- section 12 - People are also looking for --}}
    @include('frontend.partials.section_12')

    {{-- section 13 - Our Services --}}
    @include('frontend.partials.section_13')

    <script>
        function goToPreviousPage() {
            const previousPageUrl = "{{ $products->previousPageUrl() }}";
            if (previousPageUrl) {
                window.location.href = previousPageUrl;
            }
        }

        function goToNextPage() {
            const nextPageUrl = "{{ $products->nextPageUrl() }}";
            if (nextPageUrl) {
                window.location.href = nextPageUrl;
            }
        }
    </script>
@endsection

