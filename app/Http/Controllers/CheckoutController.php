<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function Checkout(Request $request){
        $user = auth()->user();

        //validate request

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

        // Get all cart items fot the user
        $cartItems = CartItem::where('user_id',$user->id)->get();

        if($cartItems->isEmpty()){
            return response()->json(['message' => 'Cart is empty'],400);
        }

        // Calculate total price

        $totalPrice = $cartItems->sum(function($item){
            return $item->product->price * $item->quantity;
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
                'price' => $item->product->price
            ]);
        }

        // clear the users cart
        CartItem::where('user_id',$user->id)->delete();

        return response()->json([
            'message' => 'chekout successful'
        ]);
    }
}
