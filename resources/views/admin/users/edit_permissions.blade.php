@extends('admin.admin_dashboard')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Permissions for User: {{ $user->name }}</h4>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('admin.users.updatePermissions', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="roles" class="form-label">Assign Roles</label>
                            <select name="roles[]" id="roles" class="form-select" multiple>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                        @if(in_array($role->id, $userRoles)) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Assign Permissions</label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-md-4">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                   class="form-check-input"
                                                   @if(in_array($permission->id, $userPermissions)) checked @endif>
                                            <label class="form-check-label">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    });
</script>
@endsection
