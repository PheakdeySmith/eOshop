<section class="py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="bootstrap-tabs product-tabs">
                    <div class="tabs-header d-flex justify-content-between border-bottom my-5">
                        <h3>Trending Products</h3>
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <!-- 'All' Category Tab -->
                                <a href="{{ route('frontend.index', ['category' => 'all']) }}"
                                    class="nav-link text-uppercase fs-6 {{ request('category') == 'all' || !request('category') ? 'active' : '' }}"
                                    id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all">All</a>

                                <!-- 'Vegetables' Category Tab -->
                                <a href="{{ route('frontend.index', ['category' => 'Vegetables']) }}"
                                    class="nav-link text-uppercase fs-6 {{ request('category') == 'Vegetables' ? 'active' : '' }}"
                                    id="nav-Vegetables-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-Vegetables">Vegetables & Veges</a>

                                <!-- 'Beverages' Category Tab -->
                                <a href="{{ route('frontend.index', ['category' => 'Beverages']) }}"
                                    class="nav-link text-uppercase fs-6 {{ request('category') == 'Beverages' ? 'active' : '' }}"
                                    id="nav-Beverages-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-Beverages">Beverages</a>
                            </div>
                        </nav>
                    </div>
                    <div class="tab-content" id="nav-tabContent">
                        <!-- All Products Tab -->
                        <div class="tab-pane fade {{ request('category') == 'all' || !request('category') ? 'show active' : '' }}"
                            id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                            <!-- Product Grid for All Products -->
                            <div
                                class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                                @foreach ($products as $product)
                                    <div class="col">
                                        <div class="product-item">
                                            @if ($product->on_sale)
                                                <span
                                                    class="badge bg-success position-absolute m-3">-{{ $product->discount_price ? number_format(100 - ($product->discount_price / $product->price) * 100, 2) : 0 }}%</span>
                                            @endif
                                            <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                    <use xlink:href="#heart"></use>
                                                </svg></a>
                                            <figure>
                                                <a href="" title="{{ $product->product_name }}">
                                                    <img src="{{ asset('storage/' . $product->image) }}" class="tab-image"
                                                        alt="{{ $product->product_name }}">
                                                </a>
                                            </figure>
                                            <h3>{{ $product->product_name }}</h3>
                                            <span class="qty">1 Unit</span>
                                            <span class="rating">
                                                <svg width="24" height="24" class="text-primary">
                                                    <use xlink:href="#star-solid"></use>
                                                </svg> 4.5
                                            </span>
                                            <span class="price">${{ number_format($product->price, 2) }}</span>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="input-group product-qty">
                                                    <button type="button"
                                                        class="quantity-left-minus btn btn-danger btn-number"
                                                        data-type="minus"><svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg></button>
                                                    <input type="text" id="quantity" name="quantity"
                                                        class="form-control input-number" value="1">
                                                    <button type="button"
                                                        class="quantity-right-plus btn btn-success btn-number"
                                                        data-type="plus"><svg width="16" height="16">
                                                            <use xlink:href="#plus"></use>
                                                        </svg></button>
                                                </div>
                                                <a href="#" class="nav-link">Add to Cart <iconify-icon
                                                        icon="uil:shopping-cart"></iconify-icon></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Vegetables Tab -->
                        <div class="tab-pane fade {{ request('category') == 'Vegetables' ? 'show active' : '' }}"
                            id="nav-Vegetables" role="tabpanel" aria-labelledby="nav-Vegetables-tab">
                            <!-- Product Grid for Vegetables -->
                            <div
                                class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                                @foreach ($products as $product)
                                    @if ($product->category->category_name == 'Vegetables')
                                        <div class="col">
                                            <div class="product-item">
                                                @if ($product->on_sale)
                                                    <span
                                                        class="badge bg-success position-absolute m-3">-{{ $product->discount_price ? number_format(100 - ($product->discount_price / $product->price) * 100, 2) : 0 }}%</span>
                                                @endif
                                                <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                        <use xlink:href="#heart"></use>
                                                    </svg></a>
                                                <figure>
                                                    <a href="" title="{{ $product->product_name }}">
                                                        <img src="{{ asset('storage/' . $product->image) }}" class="tab-image"
                                                            alt="{{ $product->product_name }}">
                                                    </a>
                                                </figure>
                                                <h3>{{ $product->product_name }}</h3>
                                                <span class="qty">1 Unit</span>
                                                <span class="rating"><svg width="24" height="24" class="text-primary">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg> 4.5</span>
                                                <span class="price">${{ number_format($product->price, 2) }}</span>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="input-group product-qty">
                                                        <button type="button"
                                                            class="quantity-left-minus btn btn-danger btn-number"
                                                            data-type="minus"><svg width="16" height="16">
                                                                <use xlink:href="#minus"></use>
                                                            </svg></button>
                                                        <input type="text" id="quantity" name="quantity"
                                                            class="form-control input-number" value="1">
                                                        <button type="button"
                                                            class="quantity-right-plus btn btn-success btn-number"
                                                            data-type="plus"><svg width="16" height="16">
                                                                <use xlink:href="#plus"></use>
                                                            </svg></button>
                                                    </div>
                                                    <a href="#" class="nav-link">Add to Cart <iconify-icon
                                                            icon="uil:shopping-cart"></iconify-icon></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Beverages Tab -->
                        <div class="tab-pane fade {{ request('category') == 'Beverages' ? 'show active' : '' }}"
                            id="nav-Beverages" role="tabpanel" aria-labelledby="nav-Beverages-tab">
                            <!-- Product Grid for Beverages -->
                            <div
                                class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                                @foreach ($products as $product)
                                    @if ($product->category->category_name == 'Beverages')
                                        <div class="col">
                                            <div class="product-item">
                                                @if ($product->on_sale)
                                                    <span
                                                        class="badge bg-success position-absolute m-3">-{{ $product->discount_price ? number_format(100 - ($product->discount_price / $product->price) * 100, 2) : 0 }}%</span>
                                                @endif
                                                <a href="#" class="btn-wishlist"><svg width="24" height="24">
                                                        <use xlink:href="#heart"></use>
                                                    </svg></a>
                                                <figure>
                                                    <a href="" title="{{ $product->product_name }}">
                                                        <img src="{{ asset('storage/' . $product->image) }}" class="tab-image"
                                                            alt="{{ $product->product_name }}">
                                                    </a>
                                                </figure>
                                                <h3>{{ $product->product_name }}</h3>
                                                <span class="qty">1 Unit</span>
                                                <span class="rating"><svg width="24" height="24" class="text-primary">
                                                        <use xlink:href="#star-solid"></use>
                                                    </svg> 4.5</span>
                                                <span class="price">${{ number_format($product->price, 2) }}</span>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="input-group product-qty">
                                                        <button type="button"
                                                            class="quantity-left-minus btn btn-danger btn-number"
                                                            data-type="minus"><svg width="16" height="16">
                                                                <use xlink:href="#minus"></use>
                                                            </svg></button>
                                                        <input type="text" id="quantity" name="quantity"
                                                            class="form-control input-number" value="1">
                                                        <button type="button"
                                                            class="quantity-right-plus btn btn-success btn-number"
                                                            data-type="plus"><svg width="16" height="16">
                                                                <use xlink:href="#plus"></use>
                                                            </svg></button>
                                                    </div>
                                                    <a href="#" class="nav-link">Add to Cart <iconify-icon
                                                            icon="uil:shopping-cart"></iconify-icon></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
