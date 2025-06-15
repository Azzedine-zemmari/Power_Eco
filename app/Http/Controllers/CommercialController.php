<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommercialController extends Controller
{
    /**
     * Retrieve sales data by joining orders and order_items tables.
     * The returned JSON response is grouped by orderId and includes:
     * - orderId: ID of the order
     * - status: Status of the order
     * - productId: ID of the product in the order
     * - quantity: Quantity of the product in the order
     * - price: Price of the product in the order
     * - totalPrice: Total price of the order
     *
     * @return \Illuminate\Http\JsonResponse
     */
   public function sales(Request $request)
{
    $perPage = $request->get('per_page', 10);
    $page = $request->get('page', 1);

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
        )
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
public function update(int $id, Request $request)
{
    $validated = $request->validate([
        'status' => 'required|string'
    ]);

    try {
        $sale = Order::findOrFail($id);
        $sale->status = $validated['status'];
        $sale->save();

        return response()->json($sale);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Order not found or update failed.'], 404);
    }
}

}
