<section class="py-5 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                    <h2 class="section-title">Category</h2>

                    <div class="d-flex align-items-center">
                        <a href="{{ route('frontend.shop') }}" class="btn-link text-decoration-none">View All Categories →</a>
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
                        @foreach ($categories as $category)
                            <a href="{{ route('frontend.index', ['category' => $category->category_name]) }}" class="nav-link category-item swiper-slide">
                                <img src="{{ asset('storage/' . $category->icon) }}" alt="Category Thumbnail">
                                <h3 class="category-title">{{ $category->category_name }}</h3>
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
