<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
{
    $cartItems = Auth::check()
    ? Cart::where('user_id', Auth::id())->with('product')->get()
    : collect(session()->get('cart', []));


    return view('frontend.cart.index', compact('cartItems'));
}

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->first();

            if ($cart) {
                $cart->quantity += 1;
                $cart->save();
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price
                ]);
            }
        } else {
            $cartData = session()->get('cart', []);
            $existingCartItemKey = null;

            foreach ($cartData as $index => $item) {
                if ($item['product_id'] == $product->id) {
                    $existingCartItemKey = $index;
                    break;
                }
            }

            if ($existingCartItemKey !== null) {
                $cartData[$existingCartItemKey]['quantity'] += 1;
            } else {
                $cartData[] = [
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price
                ];
            }

            session()->put('cart', $cartData);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function removeCartItem($cartItemId)
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->where('id', $cartItemId)->delete();
        } else {
            $cartData = session()->get('cart', []);
            unset($cartData[$cartItemId]);
            session()->put('cart', array_values($cartData));
        }

        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    // New Function: Update Cart Item Quantity
    public function updateCartItem(Request $request, $cartItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())->where('id', $cartItemId)->first();
            if ($cartItem) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
            }
        } else {
            $cartData = session()->get('cart', []);
            if (isset($cartData[$cartItemId])) {
                $cartData[$cartItemId]['quantity'] = $request->quantity;
                session()->put('cart', $cartData);
            }
        }

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }

    // New Function: Clear Cart
    public function clearCart()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->back()->with('success', 'Cart cleared successfully.');
    }
}
