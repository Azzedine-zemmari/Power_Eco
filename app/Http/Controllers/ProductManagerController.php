<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductManagerController extends Controller
{
    public function getStats()
    {
        try {
            // Get raw counts for debugging
            $productCount = DB::table('products')->count();
            $categoryCount = DB::table('categories')->count();
            $salesTotal = DB::table('orders')
                ->where('status', 'received')
                ->sum('total_price');

            $stats = [
                'totalProducts' => $productCount,
                'totalCategories' => $categoryCount,
                'totalSales' => $salesTotal
            ];

            return response()->json($stats);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch statistics'], 500);
        }
    }
} 