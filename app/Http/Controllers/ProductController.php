<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name' => 'required|string|min:5',
            'description' => 'required|string|min:20',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath =  $request->file('image')->store('image','public');
        }
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'categorie_id' => $request->categorie_id,
            'image' => $imagePath,
            'status' => $request->status
        ]);
        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);
    }
}
