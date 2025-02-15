@extends('admin.admin_dashboard')

@section('content')

    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Include Bootstrap DateTimePicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product List</h4>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#createProductModal">New Product</button>
                        </div>
                        <div class="input-group" style="width: 300px;">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Code</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Sale Price</th>
                                    <th>Status</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Featured</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody">
                                @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->product_code }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->category->category_name }}</td>
                                        <td>${{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->stock_quantity }}</td>
                                        <td>
                                            @if($item->discount_price)
                                                ${{ number_format($item->discount_price, 2) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status)
                                                <span class="badge bg-success">{{ ucfirst($item->status) }}</span>
                                            @else
                                                <span class="badge bg-secondary">Unavailable</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->slug }}</td>
                                        <td>
                                            @if($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="Product Image"
                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->on_sale)
                                                <span class="badge bg-warning">On Sale</span>
                                            @else
                                                <span class="badge bg-secondary">Regular</span>
                                            @endif
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <button class="btn btn-sm btn-primary me-2 edit-btn" data-id="{{ $item->id }}"
                                                data-product_code="{{ $item->product_code }}"
                                                data-name="{{ $item->product_name }}"
                                                data-price="{{ $item->price }}"
                                                data-category="{{ $item->category_id }}"
                                                data-stock="{{ $item->stock_quantity }}"
                                                data-description="{{ $item->description }}"
                                                data-image="{{ $item->image }}"
                                                data-status="{{ $item->status }}"
                                                data-discount_price="{{ $item->discount_price }}"
                                                data-slug="{{ $item->slug }}"
                                                data-weight="{{ $item->weight }}"
                                                data-dimensions="{{ $item->dimensions }}"
                                                data-on_sale="{{ $item->on_sale }}" data-bs-toggle="modal"
                                                data-bs-target="#editProductModal">
                                                Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id }}"
                                                data-bs-toggle="modal" data-bs-target="#deleteProductModal">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
                            products
                        </div>
                        <div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $products->previousPageUrl() }}"
                                            aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                                        <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                                        <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.products.create')
    @include('admin.products.edit')
    @include('admin.products.destroy')

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Display SweetAlert2 messages from session
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const productTableBody = document.getElementById('productTableBody');
            const rows = productTableBody.getElementsByTagName('tr');

            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();

                Array.from(rows).forEach(function (row) {
                    const rowData = row.textContent.toLowerCase();
                    if (rowData.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Edit Button
            let editBtns = document.querySelectorAll('.edit-btn');
            editBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    let id = this.getAttribute('data-id');
                    let productCode = this.getAttribute('data-product_code');
                    let productName = this.getAttribute('data-name');
                    let price = this.getAttribute('data-price');
                    let categoryId = this.getAttribute('data-category');
                    let stock = this.getAttribute('data-stock');
                    let description = this.getAttribute('data-description');
                    let image = this.getAttribute('data-image');
                    let status = this.getAttribute('data-status');
                    let discountPrice = this.getAttribute('data-discount_price');
                    let slug = this.getAttribute('data-slug');
                    let weight = this.getAttribute('data-weight');
                    let dimensions = this.getAttribute('data-dimensions');
                    let onSale = this.getAttribute('data-on_sale');

                    // Populate modal with data
                    document.getElementById('editProductCode').value = productCode;
                    document.getElementById('editProductName').value = productName;
                    document.getElementById('editProductPrice').value = price;
                    document.getElementById('editProductCategory').value = categoryId;
                    document.getElementById('editProductStock').value = stock;
                    document.getElementById('editProductDescription').value = description;
                    document.getElementById('editProductStatus').value = status;
                    document.getElementById('editProductSalePrice').value = discountPrice;
                    document.getElementById('editProductSlug').value = slug;
                    document.getElementById('editProductWeight').value = weight;
                    document.getElementById('editProductDimensions').value = dimensions;
                    document.getElementById('editProductOnSale').checked = onSale === '1';

                    if (image) {
                        document.getElementById('editProductImagePreview').src = '/storage/' + image;
                        document.getElementById('editProductImagePreview').style.display = 'block';
                    }

                    document.getElementById('editProductForm').action = `/products/${id}`;
                });
            });

            // Delete Button
            let deleteBtns = document.querySelectorAll('.delete-btn');
            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    let id = this.getAttribute('data-id');
                    document.getElementById('deleteProductId').value = id;
                    document.getElementById('deleteProductForm').action = '/products/' + id;
                });
            });
        });
    </script>
@endsection
