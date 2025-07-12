<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

        $user = $request->user();
        
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $cartItem = CartItem::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

    return response()->json(['message' => 'Added to cart successfully']);
}
public function getCartItem(Request $request)
{
    $user = $request->user();
    
    if (!$user) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $cartItems = CartItem::where('user_id', $user->id)
        ->join('products', 'cart_items.product_id', '=', 'products.id')
        ->select(
            'cart_items.*',
            'products.name as product_name',
            'products.price as product_price',
            'products.image as product_image'
        )
        ->get();

    // Log cart items for debugging
    \Illuminate\Support\Facades\Log::info('Cart items for user ' . $user->id . ':', $cartItems->toArray());

    return response()->json([
        'cart_items' => $cartItems
    ]);
}
public function update(Request $request, $productId)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $user = $request->user();
    
    if (!$user) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $cartItem = CartItem::where('user_id', $user->id)
                        ->where('product_id', $productId)
                        ->first();

    if (!$cartItem) {
        return response()->json(['message' => 'Item not found'], 404);
    }

    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    return response()->json(['message' => 'Quantity updated']);
}
    public function dropItem(Request $request, int $id)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $cartItem = CartItem::where('id', $id)
                        ->where('user_id', $user->id)
                        ->first();
                        
        if (!$cartItem) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $cartItem->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
    public function count(Request $request)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $count = CartItem::where('user_id', $user->id)->count();
        return response()->json($count);
    }
}