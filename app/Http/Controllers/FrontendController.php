<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home(Request $request)
    {
        $category = $request->get('category', 'all');

        if ($category == 'all') {
            $products = Product::take(10)->get();
        } else {
            $products = Product::where('category', $category)->take(10)->get();
        }

        $categories = Category::where('status', '1')->get();

        return view('frontend.index', compact('products', 'categories'));
    }

    public function shop(Request $request)
    {
        // Get the selected category from the request
        $category = $request->get('category', 'all');

        // Fetch products based on the selected category
        if ($category == 'all') {
            $products = Product::paginate(12); // Show all products
        } else {
            // Filter products by category name using the relationship
            $products = Product::whereHas('category', function ($query) use ($category) {
                $query->where('category_name', $category);
            })->paginate(12);
        }

        // Fetch all active categories
        $categories = Category::where('status', '1')->get();

        // Pass data to the view
        return view('frontend.shopping.index', compact('products', 'categories', 'category'));
    }
}
