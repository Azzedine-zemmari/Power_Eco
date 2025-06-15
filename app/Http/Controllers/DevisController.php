<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DevisController extends Controller
{
    public function show(){
        $product = Product::all();
        return response()->json($product);
    }
}
