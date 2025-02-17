<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" action="" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- User Name -->
                    <div class="mb-3">
                        <label for="editUserName" class="form-label">User Name</label>
                        <input id="editUserName" class="form-control" name="name" type="text" required>
                    </div>

                    <!-- User Email -->
                    <div class="mb-3">
                        <label for="editUserEmail" class="form-label">User Email</label>
                        <input id="editUserEmail" class="form-control" name="email" type="email" required>
                    </div>

                    <!-- User Status -->
                    <div class="mb-3">
                        <label for="editUserStatus" class="form-label">Status</label>
                        <select id="editUserStatus" class="form-control" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
