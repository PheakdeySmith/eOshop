<section class="overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex flex-wrap justify-content-between">
                    <h2 class="section-title">Category</h2>
                    <div class="d-flex align-items-center">
                        <div class="swiper-buttons">
                            <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
                            <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="category-carousel swiper">
                    <div class="swiper-wrapper">
                        <!-- Add "All" Category Link -->
                        <a href="{{ route('frontend.shop') }}" class="nav-link category-item swiper-slide text-center p-2">
                            <h3 class="category-title fs-9 mt-2">All</h3>
                            <h3 class="category-title fs-9 mt-2">Categories</h3>
                        </a>
                        <!-- Loop Through Categories -->
                        @foreach ($categories as $category)
                            <a href="{{ route('frontend.shop', ['category' => $category->category_name]) }}" class="nav-link category-item swiper-slide text-center p-2">
                                <img src="{{ asset('storage/' . $category->icon) }}" alt="Category Thumbnail" class="img-fluid" style="max-height: 40px; object-fit: contain;">
                                <h3 class="category-title fs-9 mt-2">{{ $category->category_name }}</h3>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
