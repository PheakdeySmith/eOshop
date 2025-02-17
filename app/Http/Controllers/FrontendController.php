<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
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

    public function checkout()
    {
        $cartItems = [];

    if (Auth::check()) {
        // Fetch cart items for logged-in user
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
    } else {
        // Fetch cart items from session for guests
        $cartItems = collect(session()->get('cart', []));
    }

        return view('frontend.shopping.checkout', compact('cartItems'));
    }

    public function order()
{
    // Fetch cart items based on the user's authentication status
    $cartItems = [];

    if (Auth::check()) {
        // Fetch cart items for logged-in user
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
    } else {
        // Fetch cart items from session for guests
        $cartItems = collect(session()->get('cart', []));
    }

    // Check if an order was already created and passed from the checkout success
    $orderWithItems = null;
    if (session()->has('order_created')) {
        $orderWithItems = Order::with('orderItems.product')->find(session('order_created'));
    }

    // Return the view with both cart items and order data
    return view('frontend.shopping.orders', compact('cartItems', 'orderWithItems'));
}
public function showOrder($id)
{
    // Fetch cart items based on the user's authentication status
    $cartItems = [];

    if (Auth::check()) {
        // Fetch cart items for logged-in user
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
    } else {
        // Fetch cart items from session for guests
        $cartItems = collect(session()->get('cart', []));
    }

    // Check if an order was already created and passed from the checkout success
    $orderWithItems = null;
    if (session()->has('order_created')) {
        $orderWithItems = Order::with('orderItems.product')->find(session('order_created'));
    }
    // Fetch the order with its items and related product details
    $order = Order::with('orderItems.product')->findOrFail($id);

    // Return the order confirmation view
    return view('frontend.shopping.orders', compact('cartItems', 'orderWithItems'));
}
}
