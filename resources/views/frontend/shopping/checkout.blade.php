@extends('frontend.master')

@section('content')

    {{-- checkout-card --}}
    <section class="overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                <div class="container my-5">
                    <div class="row">
                        <!-- Shopping Cart -->
                        <div class="col-md-8">
                            <h4 class="mb-3">Shopping Cart <span class="text-muted">{{ $cartItems->sum('quantity') }}
                                    items</span></h4>
                            <ul class="list-group mb-3">
                                @foreach ($cartItems as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <!-- Product Image & Name -->
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $item->product->image) ?? asset('default.jpg') }}" alt="Product" class="img-fluid" width="50">
                                            <div class="ms-2 flex-grow-1">
                                                <h6 class="my-0">{{ $item->product->product_name }}</h6>
                                                <small class="text-muted">{{ Str::limit($item->product->description, 50, '...') }}</small>
                                            </div>
                                        </div>

                                        <!-- Quantity Controls -->
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-outline-secondary btn-sm">-</button>
                                            <span class="mx-2">{{ $item->quantity }}</span>
                                            <button class="btn btn-outline-secondary btn-sm">+</button>
                                        </div>

                                        <!-- Price -->
                                        <span class="text-muted">${{ number_format($item->price * $item->quantity, 2) }}</span>

                                        <!-- Remove Button -->
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ms-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">×</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>

                            <a href="{{ route('frontend.shop') }}" class="text-muted">← Back to shop</a>
                        </div>
                        <!-- Summary -->
                        <div class="col-md-4">
                            <div class="card p-3">
                                <h5 class="mb-3">Summary</h5>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Items {{ $cartItems->sum('quantity') }}</span>
                                        <strong>€{{ number_format($cartItems->sum(fn($item) => $item->price * $item->quantity), 2) }}</strong>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Shipping</span>
                                        <strong>€{{ number_format($shippingCost = 5.00, 2) }}</strong>
                                    </li>
                                    <li class="list-group-item">
                                        <label for="promo">Give Code</label>
                                        <input type="text" class="form-control mt-2" id="promo" placeholder="Enter your code">
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between bg-light">
                                        <span>Total Price</span>
                                        <strong>€{{ number_format($cartItems->sum(fn($item) => $item->price * $item->quantity) + $shippingCost, 2) }}</strong>
                                    </li>
                                </ul>
                                <form action="{{ route('frontend.checkout.session.create') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cartItems" value="{{ json_encode($cartItems) }}">
                                    <button class="btn btn-dark w-100" type="submit">CHECKOUT</button>
                                </form>
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

@endsection

@section('scripts')
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show SweetAlert2 success message if the session has success
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
            // Show SweetAlert2 error message if the session has error
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    showConfirmButton: true,
                    timer: 5000
                });
            @endif
        });
    </script>
@endsection
