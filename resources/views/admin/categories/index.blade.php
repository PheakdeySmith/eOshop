@extends('admin.admin_dashboard')

@section('content')
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Category List</h4>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">New Category</button>
                        <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="width: 300px;">
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="categoryTableBody">
                                @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>
                                            @if($item->icon)
                                                <img src="{{ asset('storage/' . $item->icon) }}" alt="Category Icon" width="50" height="50">
                                            @else
                                                <span>No Icon</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $item->status ? 'bg-success' : 'bg-secondary' }}">{{ $item->status ? 'Active' : 'Inactive' }}</span>
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <button class="btn btn-sm btn-primary me-2 edit-btn" data-id="{{ $item->id }}" data-category_name="{{ $item->category_name }}" data-icon="{{ $item->icon }}" data-status="{{ $item->status }}" data-bs-toggle="modal" data-bs-target="#editCategoryModal">Edit</button>
                                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="text-muted">Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} categories</span>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.categories.create')
    @include('admin.categories.edit')
    @include('admin.categories.destroy')
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

        document.getElementById('searchInput').addEventListener('input', function () {
            let searchTerm = this.value.toLowerCase();
            document.querySelectorAll('#categoryTableBody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
        });

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('editCategoryName').value = this.dataset.category_name;
                document.getElementById('editCategoryStatus').value = this.dataset.status;
                document.getElementById('editCategoryForm').action = `/categories/${this.dataset.id}`;

                let preview = document.getElementById('editCategoryIconPreview');
                if (this.dataset.icon) {
                    preview.src = `/storage/${this.dataset.icon}`;
                    preview.style.display = 'block';
                } else {
                    preview.style.display = 'none';
                }
            });
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('deleteCategoryId').value = this.dataset.id;
                document.getElementById('deleteCategoryForm').action = `/categories/${this.dataset.id}`;
            });
        });
    });
</script>
@endsection
