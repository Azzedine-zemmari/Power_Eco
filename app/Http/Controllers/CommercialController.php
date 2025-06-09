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
   public function sales()
{
    $sales = DB::table('orders')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->select(
            'orders.id as orderId',
            'orders.status as status',
            'orders.total_price as totalPrice',
            'order_items.product_id as productId',
            'order_items.quantity as quantity',
            'order_items.price as price'
        )
        ->orderBy('orders.id')
        ->get()
        ->groupBy('orderId');

    $result = [];

    foreach ($sales as $orderId => $items) {
        $firstItem = $items->first();
        $result[] = [
            'orderId' => $orderId,
            'status' => $firstItem->status,
            'totalPrice' => $firstItem->totalPrice,
            'products' => $items->map(function ($item) {
                return [
                    'productId' => $item->productId,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ];
            })->values()
        ];
    }

    return response()->json($result);
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
