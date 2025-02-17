@extends('admin.admin_dashboard')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Order List</h4>

                    <div class="d-flex justify-content-end mb-4">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="width: 300px;">
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr data-bs-toggle="collapse" data-bs-target="#orderItems{{ $order->id }}" class="clickable-row">
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>
                                            <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                        <td class="d-flex align-items-center">
                                            {{-- <button class="btn btn-sm btn-primary me-2 edit-btn"
                                                    data-id="{{ $order->id }}"
                                                    data-user_name="{{ $order->user->name }}"
                                                    data-total_amount="{{ $order->total_amount }}"
                                                    data-status="{{ $order->status }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editOrderModal">
                                                Edit
                                            </button> --}}
                                            <button class="btn btn-sm btn-danger delete-btn"
                                                    data-id="{{ $order->id }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteOrderModal">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5">
                                            <div id="orderItems{{ $order->id }}" class="collapse">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order->orderItems as $item)
                                                            <tr>
                                                                <td>{{ $item->product->product_name }}</td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>${{ number_format($item->price, 2) }}</td>
                                                                <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="text-muted">Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} orders</span>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.orders.create')
    @include('admin.orders.edit')
    @include('admin.orders.destroy')
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
            Swal.fire({ icon: 'success', title: 'Success', text: "{{ session('success') }}", showConfirmButton: false, timer: 3000 });
        @endif
        @if (session('error'))
            Swal.fire({ icon: 'error', title: 'Error', text: "{{ session('error') }}", showConfirmButton: false, timer: 3000 });
        @endif

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('deleteOrderId').value = this.dataset.id;
                document.getElementById('deleteOrderForm').action = `/orders/${this.dataset.id}`;
            });
        });
    });
</script>
@endsection
