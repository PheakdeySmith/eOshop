<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show all orders with order items
    public function index(Request $request)
    {
        $products = Product::all();
        $users = User::all();
        $search = $request->input('search');

        // Paginate orders with user and order items
        $orders = Order::with(['user', 'orderItems.product']) // Include related user & order items with products
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('admin.orders.index', compact('orders', 'users', 'products'));
    }

    // Show the create order form
    public function create()
    {
        return view('admin.orders.create');
    }

    // Store a new order
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:completed,pending,canceled',
            'products' => 'required|array', // Expecting products as an array
            'products.*.id' => 'exists:products,id', // Validate each product ID
            'products.*.quantity' => 'required|numeric|min:1', // Validate quantity
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
        ]);

        // Attach products to the order
        foreach ($request->products as $productData) {
            $product = Product::find($productData['id']);
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $productData['quantity'],
                    'price' => $product->price,
                ]);
            }
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    // Show the edit order form
    public function edit($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    // Update an existing order
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:completed,pending,canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->only(['status']));

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Delete related order items first
        OrderItem::where('order_id', $id)->delete();

        // Delete the order
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
