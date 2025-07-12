<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FactureController extends Controller
{
     public function show(Request $request)
{
    $perPage = $request->get('per_page', 10);
    $page = $request->get('page', 1);

    $user = $request->user();
    
    if (!$user) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    $query = DB::table('orders')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->select(
            'orders.id as orderId',
            'orders.status as status',
            'orders.total_price as totalPrice',
            'order_items.product_id as productId',
            'order_items.quantity as quantity',
            'order_items.price as price',
            'orders.email as email',
            'orders.phone as phone',
            'orders.last_name as lastname',
            'orders.first_name as firstname' ,
            'orders.created_at as created_at'           
        )->where('orders.user_id', $user->id)
        ->orderBy('orders.id', 'desc');

    // Get total count before pagination
    $total = $query->count();

    // Apply pagination
    $sales = $query->skip(($page - 1) * $perPage)
                  ->take($perPage)
                  ->get()
                  ->groupBy('orderId');

    $result = [];

    foreach ($sales as $orderId => $items) {
        $firstItem = $items->first();
        $result[] = [
            'orderId' => $orderId,
            'status' => $firstItem->status,
            'totalPrice' => $firstItem->totalPrice,
            'firstname' => $firstItem->firstname,
            'lastname' => $firstItem->lastname,
            'email' => $firstItem->email,
            'phone' => $firstItem->phone,
            'created_at' => $firstItem->created_at,
            'products' => $items->map(function ($item) {
                return [
                    'productId' => $item->productId,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ];
            })->values()
        ];
    }

    return response()->json([
        'data' => $result,
        'total' => $total,
        'per_page' => $perPage,
        'current_page' => $page,
        'last_page' => ceil($total / $perPage)
    ]);
}
}
