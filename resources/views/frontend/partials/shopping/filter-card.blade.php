<div class="col-md-3">
    <div class="card shadow-sm p-3 mb-5 bg-body rounded">
        <h5 class="card-title">Filter</h5>
        <!-- Static filter options form -->
        <form>
            <!-- Category Filter -->
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select id="category-filter" class="form-select">
                    <option selected disabled>Choose category</option>
                    @foreach ($categories as $category)
                        <option value="{{ route('frontend.shop', ['category' => $category->category_name]) }}">
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Price Range Filter -->
            <div class="mb-3">
                <label for="price" class="form-label">Price Range</label>
                <input type="number" class="form-control mb-2" id="price_min" placeholder="Min Price" value="50">
                <input type="number" class="form-control" id="price_max" placeholder="Max Price" value="500">
            </div>

            <!-- Brand Filter -->
            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <select id="brand" class="form-select">
                    <option selected>Choose brand</option>
                    <option value="1">Brand A</option>
                    <option value="2">Brand B</option>
                    <option value="3">Brand C</option>
                </select>
            </div>

            <!-- Rating Filter -->
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select id="rating" class="form-select">
                    <option selected>Choose rating</option>
                    <option value="4">4 stars & above</option>
                    <option value="3">3 stars & above</option>
                    <option value="2">2 stars & above</option>
                </select>
            </div>

            <!-- Stock Availability Filter -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="in_stock">
                <label class="form-check-label" for="in_stock">In Stock Only</label>
            </div>

            <!-- Color Filter -->
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <select id="color" class="form-select">
                    <option selected>Choose color</option>
                    <option value="red">Red</option>
                    <option value="blue">Blue</option>
                    <option value="green">Green</option>
                    <option value="black">Black</option>
                </select>
            </div>

            <!-- Newest Arrivals Filter -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="new_arrivals">
                <label class="form-check-label" for="new_arrivals">Newest Arrivals</label>
            </div>

            <!-- Discount/Deals Filter -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="on_sale">
                <label class="form-check-label" for="on_sale">On Sale</label>
            </div>

            <!-- Shipping Options Filter -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="free_shipping">
                <label class="form-check-label" for="free_shipping">Free Shipping</label>
            </div>

            <!-- Condition Filter -->
            <div class="mb-3">
                <label for="condition" class="form-label">Condition</label>
                <select id="condition" class="form-select">
                    <option selected>Choose condition</option>
                    <option value="new">New</option>
                    <option value="used">Used</option>
                    <option value="refurbished">Refurbished</option>
                </select>
            </div>

            <!-- Apply Filters Button -->
            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
        </form>
    </div>
</div>
<script>
    document.getElementById('category-filter').addEventListener('change', function () {
        let selectedUrl = this.value;
        if (selectedUrl) {
            window.location.href = selectedUrl;
        }
    });
</script>
