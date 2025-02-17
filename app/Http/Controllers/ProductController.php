<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $search = $request->input('search');

        $products = Product::when($search, function ($query, $search) {
            return $query->where('product_name', 'like', "%{$search}%")
                ->orWhere('product_code', 'like', "%{$search}%");
        })
            ->paginate(10);

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_code' => 'required|unique:products',
                'product_name' => 'required',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'stock_quantity' => 'required|integer',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'on_sale' => 'nullable|boolean',
                'discount_price' => 'nullable|numeric',
                'slug' => 'required|unique:products',
                'weight' => 'nullable|numeric',
                'dimensions' => 'nullable|string',
                'status' => 'required|in:available,unavailable',
            ]);

            $productData = $request->only([
                'product_code',
                'product_name',
                'price',
                'category_id',
                'stock_quantity',
                'description',
                'on_sale',
                'discount_price',
                'slug',
                'weight',
                'dimensions',
                'status'
            ]);

            if ($request->hasFile('image')) {
                $productData['image'] = $request->file('image')->store('product_images', 'public');
            }

            Product::create($productData);

            return redirect()->route('products.index')->with('success', 'Product created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating product: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $validatedData = $request->validate([
                'product_name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'stock_quantity' => 'required|integer',
                'description' => 'nullable|string',
                'discount_price' => 'nullable|numeric',
                'status' => 'nullable|string',
                'slug' => 'required|string|unique:products,slug,' . $product->id,
                'weight' => 'nullable|numeric',
                'dimensions' => 'nullable|string',
                'on_sale' => 'nullable|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }

                $validatedData['image'] = $request->file('image')->store('product_images', 'public');
            }

            $product->update($validatedData);

            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting product: ' . $e->getMessage());
        }
    }

    public function filterProducts(Request $request)
    {
        $cartItems = [];
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->get();
        } else {
            $cartItems = session()->get('cart', []);
        }

        $query = Product::query();

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('price_min') && $request->price_min != '') {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->has('price_max') && $request->price_max != '') {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->has('stock_min') && $request->stock_min != '') {
            $query->where('stock_quantity', '>=', $request->stock_min);
        }

        if ($request->has('stock_max') && $request->stock_max != '') {
            $query->where('stock_quantity', '<=', $request->stock_max);
        }

        if ($request->has('on_sale') && $request->on_sale != '') {
            $query->where('on_sale', $request->on_sale);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('product_name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10);

        return view('frontend.new_arrival.index', compact('products', 'cartItems'));
    }
}
