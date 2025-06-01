<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }


    return response()->json(['message' => 'Added to cart successfully']);
}
public function getCartItem()
{
    $cartItems = CartItem::where('user_id', auth()->id())
        ->join('products', 'cart_items.product_id', '=', 'products.id')
        ->select(
            'cart_items.*',
            'products.name as product_name',
            'products.price as product_price',
            'products.image as product_image',
            'products.name as product_name'
        )
        ->get();

    return response()->json([
        'cart_items' => $cartItems
    ]);
}
public function update(Request $request, $productId)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $cartItem = CartItem::where('user_id', auth()->id())
                        ->where('product_id', $productId)
                        ->first();

    if (!$cartItem) {
        return response()->json(['message' => 'Item not found'], 404);
    }

    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    return response()->json(['message' => 'Quantity updated']);
}
    public function dropItem(int $id)
    {
        $cartItem = CartItem::where('id', $id)->first();
        if (!$cartItem) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $cartItem->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}