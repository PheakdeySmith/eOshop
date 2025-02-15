<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 row">
                        <div class="col-md-12">
                            <label for="editProductCode" class="form-label">Product Code</label>
                            <input id="editProductCode" class="form-control" name="product_code" type="text" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="editProductName" class="form-label">Product Name</label>
                            <input id="editProductName" class="form-control" name="product_name" type="text">
                        </div>
                        <div class="col-md-6">
                            <label for="editProductPrice" class="form-label">Price</label>
                            <input id="editProductPrice" class="form-control" name="price" type="number" step="0.01">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="editProductCategory">Category</label>
                            <select id="editProductCategory" class="form-control" name="category_id" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductStock">Stock Quantity</label>
                            <input type="number" class="form-control" id="editProductStock" name="stock_quantity">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-12">
                            <label for="editProductDescription">Description</label>
                            <textarea class="form-control" id="editProductDescription" name="description" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="editProductSalePrice">Sale Price</label>
                            <input type="number" class="form-control" id="editProductSalePrice" name="discount_price" step="0.01">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductStatus">Status</label>
                            <select id="editProductStatus" class="form-control" name="status">
                                <option value="available">Available</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="editProductSlug">Slug</label>
                            <input type="text" class="form-control" id="editProductSlug" name="slug">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editProductWeight">Weight (kg)</label>
                            <input type="number" class="form-control" id="editProductWeight" name="weight" step="0.01">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="form-group col-md-6">
                            <label for="editProductDimensions">Dimensions (cm)</label>
                            <input type="text" class="form-control" id="editProductDimensions" name="dimensions">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="editProductOnSale" name="on_sale" value="1">
                                <label class="form-check-label" for="editProductOnSale">On Sale</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editProductImage">Product Image</label>
                        <input type="file" class="form-control" name="image" id="editProductImage">
                        <img id="editProductImagePreview" class="img-fluid mt-2" style="display: none;" />
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
