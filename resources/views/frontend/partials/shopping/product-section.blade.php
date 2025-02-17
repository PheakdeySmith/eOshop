<div class="col-md-9">
    <div class="row">
        <div class="product-grid row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
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
                                <button type="button" class="quantity-left-minus btn btn-danger btn-number"
                                    data-type="minus"><svg width="16" height="16">
                                        <use xlink:href="#minus"></use>
                                    </svg></button>
                                <input type="text" id="quantity" name="quantity"
                                    class="form-control input-number" value="1">
                                <button type="button" class="quantity-right-plus btn btn-success btn-number"
                                    data-type="plus"><svg width="16" height="16">
                                        <use xlink:href="#plus"></use>
                                    </svg></button>
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></iconify-icon></button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
