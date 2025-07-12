<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

use function PHPUnit\Framework\isArray;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // Log the request data for debugging
        \Illuminate\Support\Facades\Log::info('Checkout request data:', $request->all());

        // Validate form data
        $validated = $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);

        // Get all cart items for the user
        $cartItems = CartItem::where('user_id',$user->id)
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->select(
                'cart_items.*',
                'products.name as product_name',
                'products.price as product_price',
                'products.stock as product_stock'
            )
            ->get();

        if($cartItems->isEmpty()){
            return response()->json(['message' => 'Cart is empty'],400);
        }

        // Calculate total price
        $totalPrice = $cartItems->sum(function($item){
            return $item->product_price * $item->quantity;
        });

        // create order with customer and shipping details
        $order = Order::create([
            'user_id' => $user->id,
            'email' => $validated['email'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'apartment' => $validated['apartment'] ?? null,
            'city' => $validated['city'],
            'postal_code' => $validated['postal_code'],
            'notes' => $validated['notes'] ?? null,
            'total_price' => $totalPrice,
        ]);

        foreach($cartItems as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product_price
            ]);
            
            // Update product stock
            $product = \App\Models\Product::where('id',$item->product_id)->first();
            if ($product) {
                $product->stock -= $item->quantity;
                $product->save();
            }
        }

        // clear the users cart
        CartItem::where('user_id',$user->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Checkout successful',
            'order_id' => $order->id
        ]);
    }
}
