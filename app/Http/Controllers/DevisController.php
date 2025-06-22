<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DevisController extends Controller
{
    public function show(){
        $product = Product::where('status','=','active')->get();
        return response()->json($product);
    }
}
