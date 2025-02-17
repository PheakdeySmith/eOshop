<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create New User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createUserForm" class="form-inline" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="createUserName" class="form-label">User Name</label>
                            <input id="createUserName" class="form-control" name="name" type="text" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="createUserEmail" class="form-label">User Email</label>
                            <input id="createUserEmail" class="form-control" name="email" type="email" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="createUserPassword" class="form-label">Password</label>
                            <input id="createUserPassword" class="form-control" name="password" type="password" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="createUserStatus" class="form-label">Status</label>
                            <select id="createUserStatus" class="form-control" name="status" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
