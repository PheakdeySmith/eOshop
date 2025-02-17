@extends('frontend.master')
@section('content')

    {{-- order-card --}}
    <section class="overflow-hidden">
        <div class="container-fluid">
            <div class="row">

                <!-- Order Details -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Order Card -->
                            <div class="card shadow-sm border-0 mb-5">
                                <div class="card-body p-4">
                                    <!-- Order Header -->
                                    @if ($orderWithItems)
                                        <div class="mb-4">
                                            <h3 class="fw-bold">Order ID: {{ $orderWithItems->id }}</h3>
                                            <span class="badge bg-primary">Trade Order</span>
                                        </div>

                                        <!-- Product Details -->
                                        @foreach($orderWithItems->orderItems as $item)
                                            <div class="border-top border-bottom py-4">
                                                <div class="row align-items-center">
                                                    <div class="col-md-3">
                                                        <!-- Product Image with smaller size -->
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->product_name }}" class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <!-- Product Name -->
                                                        <h5 class="mb-0">{{ $item->product->product_name }}</h5>
                                                    </div>
                                                    <div class="col-md-3 text-md-end">
                                                        <!-- Product Price -->
                                                        <h4 class="mb-0 text-primary">${{ number_format($item->price, 2) }}</h4>
                                                    </div>
                                                    <div class="col-md-3 text-md-end">
                                                        <!-- Product Quantity -->
                                                        <p class="mb-0">Quantity: {{ $item->quantity }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Total Row -->
                                        <div class="row py-4">
                                            <div class="col-md-6">
                                                <h5 class="mb-0">Total</h5>
                                            </div>
                                            <div class="col-md-6 text-md-end">
                                                <h4 class="mb-0 text-primary">${{ number_format($orderWithItems->total_amount, 2) }}</h4>
                                            </div>
                                        </div>

                                        <!-- Order Timeline -->
                                        <div class="py-4">
                                            <div class="d-flex justify-content-between px-3">
                                                <div class="text-center position-relative">
                                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">1</div>
                                                    <div class="step-label">Order Placed</div>
                                                    <div class="position-absolute" style="top: 20px; left: 50%; transform: translateX(-50%); width: 100%; height: 2px; background-color: #e9ecef; z-index: -1;"></div>
                                                </div>
                                                <div class="text-center position-relative">
                                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">2</div>
                                                    <div class="step-label">Processing</div>
                                                    <div class="position-absolute" style="top: 20px; left: 50%; transform: translateX(-50%); width: 100%; height: 2px; background-color: #e9ecef; z-index: -1;"></div>
                                                </div>
                                                <div class="text-center position-relative">
                                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">3</div>
                                                    <div class="step-label">Shipped</div>
                                                    <div class="position-absolute" style="top: 20px; left: 50%; transform: translateX(-50%); width: 100%; height: 2px; background-color: #e9ecef; z-index: -1;"></div>
                                                </div>
                                                <div class="text-center position-relative">
                                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">4</div>
                                                    <div class="step-label">Delivered</div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning" role="alert">
                                            No order data available. Please check your order status or try again later.
                                        </div>
                                    @endif
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

@endsection
