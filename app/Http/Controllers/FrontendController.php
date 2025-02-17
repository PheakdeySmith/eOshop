<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        $cartItems = Auth::check()
            ? Cart::where('user_id', Auth::id())->with('product')->get()
            : collect(session()->get('cart', []));


        return view('frontend.index', compact('products', 'categories', 'cartItems'));
    }

    public function shop(Request $request)
    {
        $category = $request->get('category', 'all');

        if ($category == 'all') {
            $products = Product::paginate(12);
        } else {
            $products = Product::whereHas('category', function ($query) use ($category) {
                $query->where('category_name', $category);
            })->paginate(12);
        }

        $categories = Category::where('status', '1')->get();

        $cartItems = Auth::check()
            ? Cart::where('user_id', Auth::id())->with('product')->get()
            : collect(session()->get('cart', []));

        return view('frontend.shopping.index', compact('products', 'categories', 'category', 'cartItems'));
    }
}
