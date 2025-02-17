@extends('admin.admin_dashboard')

@section('content')
    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User List</h4>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">New User</button>
                        <input type="text" id="searchInput" class="form-control" placeholder="Search..." style="width: 300px;">
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Email Verified</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge {{ $user->email_verified_at ? 'bg-success' : 'bg-secondary' }}">{{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $user->status ? 'bg-success' : 'bg-secondary' }}">{{ $user->status ? 'Active' : 'Inactive' }}</span>
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <button class="btn btn-sm btn-primary me-2 edit-btn" data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-status="{{ $user->status }}" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit</button>
                                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#deleteUserModal">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="text-muted">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users</span>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.users.create')
    @include('admin.users.edit')
    @include('admin.users.destroy')
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
            document.querySelectorAll('#userTableBody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
        });

        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('editUserName').value = this.dataset.name;
                document.getElementById('editUserEmail').value = this.dataset.email;
                document.getElementById('editUserStatus').value = this.dataset.status;
                document.getElementById('editUserForm').action = `/users/${this.dataset.id}`;
            });
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('deleteUserId').value = this.dataset.id;
                document.getElementById('deleteUserForm').action = `/users/${this.dataset.id}`;
            });
        });
    });
</script>
@endsection
