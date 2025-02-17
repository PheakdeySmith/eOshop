<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="My Cart">
    <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
                <span class="badge bg-primary rounded-pill">{{ $cartItems->count() }}</span>
            </h4>
            @if($cartItems->isEmpty())
                <p>Your cart is empty.</p>
            @else
                <ul class="list-group mb-3">
                    @foreach ($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $item['product_name'] ?? $item->product->product_name }}</h6>
                                <small class="text-body-secondary">Quantity: {{ $item['quantity'] ?? $item->quantity }}</small>
                            </div>
                            <span class="text-body-secondary">${{ number_format($item['price'] ?? $item->price, 2) }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>${{ number_format(array_sum(array_map(function($item) {
                            return ($item['price'] ?? $item->price) * ($item['quantity'] ?? $item->quantity);
                        }, $cartItems->toArray())), 2) }}</strong>
                    </li>
                </ul>

                <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
            @endif
        </div>
    </div>
</div>
