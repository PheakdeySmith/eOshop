<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Category Name -->
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Category Name</label>
                        <input id="editCategoryName" class="form-control" name="category_name" type="text" required>
                    </div>

                    <!-- Category Icon (Image) -->
                    <div class="mb-3">
                        <label for="editCategoryIcon" class="form-label">Category Icon (Image)</label>
                        <input id="editCategoryIcon" class="form-control" name="icon" type="file" accept="image/*">
                        <small class="form-text text-muted">Upload a new icon image (optional).</small>
                        <div class="mt-2">
                            <img id="editCategoryIconPreview" class="img-fluid rounded" style="max-width: 100px; display: none;" />
                        </div>
                    </div>

                    <!-- Category Status -->
                    <div class="mb-3">
                        <label for="editCategoryStatus" class="form-label">Status</label>
                        <select id="editCategoryStatus" class="form-control" name="status" required>
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

