<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $cart = json_decode($request->cartItems);

        // Store cart items in the session
        session()->put('cart', $cart);

        $lineItems = $this->prepareLineItems($cart);

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('frontend.checkout.success'),
                'cancel_url' => route('frontend.checkout.cancel'),
            ]);

            return redirect()->away($session->url);
        } catch (ApiErrorException $e) {
            return redirect()->route('frontend.checkout')->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function checkoutSuccess(Request $request)
{
    // Check if an order was already created in this session
    if (session()->has('order_created')) {
        return redirect()->route('frontend.order')->with('info', 'Your order has already been processed.');
    }

    // Retrieve cart items from session
    $cart = session()->get('cart');

    if (!$cart) {
        return redirect()->route('frontend.checkout')->with('error', 'Invalid cart data.');
    }

    DB::beginTransaction();
    try {
        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'completed',
            'total_amount' => $this->calculateTotalAmount($cart),
        ]);

        // Create order items
        $this->createOrderItems($order, $cart);

        // Clear the cart after successful order (both session and database)
        $this->clearCart();

        // Commit the transaction
        DB::commit();

        // Store the order ID in session to prevent duplicate orders
        session()->put('order_created', $order->id);

        // Redirect to order confirmation page to avoid resubmission on refresh
        return redirect()->route('frontend.order.show', $order->id)->with('success', 'Order placed successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Checkout Success Error: ' . $e->getMessage());
        return redirect()->route('frontend.checkout')->with('error', 'Order creation failed: ' . $e->getMessage());
    }
}


    public function checkoutCancel()
    {
        // Retrieve cart items if user is not logged in
        $cartItems = Auth::check() ? Cart::where('user_id', Auth::id())->with('product')->get() : collect(session()->get('cart', []));

        return view('frontend.shopping.checkout', [
            'error' => 'Payment was canceled. Please try again.',
            'cartItems' => $cartItems
        ]);
    }

    private function prepareLineItems($cartItems)
    {
        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item->product->product_name,
                    ],
                    'unit_amount' => $item->price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }

        // Add shipping cost
        $lineItems[] = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'Shipping',
                ],
                'unit_amount' => 500,
            ],
            'quantity' => 1,
        ];

        return $lineItems;
    }

    private function createOrderItems($order, $cartItems)
    {
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }
    }

    private function calculateTotalAmount($cartItems)
    {
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->price * $item->quantity;
        }

        // Add shipping cost
        $total += 5.00;

        return $total;
    }

    private function clearCart()
    {
        if (Auth::check()) {
            // Delete the cart items from the database for the logged-in user
            Cart::where('user_id', Auth::id())->delete();
        } else {
            // Clear the cart in the session for guest users
            session()->forget('cart');
        }
    }
}
