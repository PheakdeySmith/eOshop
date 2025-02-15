<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
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

}
