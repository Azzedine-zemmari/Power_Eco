<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name' => 'required|string|min:5',
            'description' => 'required|string|min:20',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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

    public function show(){
        $product = Product::all();
        return response()->json($product);
    }
    public function update(Request $request, int $id)
{
    $request->validate([
        'name' => 'required|string|min:5',
        'description' => 'required|string|min:20',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'categorie_id' => 'required|integer|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'status' => 'required|in:active,inactive'
    ]);

    $product = Product::findOrFail($id);

    if ($request->hasFile('image')) {
        // Optionally delete old image here
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $imagePath = $request->file('image')->store('image', 'public');
        $product->image = $imagePath;
    }

    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->categorie_id = $request->categorie_id;
    $product->status = $request->status;

    $product->save();

    return redirect()->back()->with('success', 'Product updated successfully.');
}

public function destroy(int $id)
{
    $product = Product::findOrFail($id);

    if ($product->image && Storage::disk('public')->exists($product->image)) {
        Storage::disk('public')->delete($product->image);
    }

    $product->delete();

    return redirect()->back()->with('success', 'Product deleted successfully.');
}
}
