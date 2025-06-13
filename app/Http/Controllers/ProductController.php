<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name' => 'required|string|min:5',
            'description' => 'required|string|min:20',
            'price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric',
            'marge' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'required|integer|exists:categories,id',
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
            'status' => $request->status,
            'sell_price' => $request->sell_price,
            'marge' => $request->marge
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
        'sell_price' => 'required|numeric',
        'marge' => 'required|numeric',
        'stock' => 'required|integer|min:0',
        'categorie_id' => 'required|integer|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'status' => 'required|in:active,inactive',
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
    $product->sell_price = $request->sell_price;
    $product->marge = $request->marge;

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
public function import(Request $request)
{
    // Validate the uploaded Excel file
    $request->validate([
        'excel_file' => 'required|file|mimes:xlsx,xls,csv',
    ]);

    $file = $request->file('excel_file');

    // Load the spreadsheet
    $spreadsheet = IOFactory::load($file->getPathname());
    $worksheet = $spreadsheet->getActiveSheet();

    // Convert to array and extract header and rows
    $rows = $worksheet->toArray();
    $header = array_map('strtolower', $rows[0]);
    unset($rows[0]);

    // Folder where your original images are on your PC (adjust this!)
    $imageSourceFolder = 'C:/Users/azzed/images/';  // Include trailing slash

    foreach ($rows as $row) {
        $data = array_combine($header, $row);

        // Skip rows without required fields
        if (!isset($data['name']) || !isset($data['price'])) {
            continue;
        }

        $imagePath = null;

        if (!empty($data['image'])) {
            $imageFilename = $data['image'];

            // Full path of the source image on your PC
            $sourcePath = $imageSourceFolder . $imageFilename;

            if (file_exists($sourcePath)) {
                // Destination path inside Laravel storage
                $destinationPath = storage_path('app/public/image/' . $imageFilename);

                // Copy file if it doesn't already exist in storage
                if (!file_exists($destinationPath)) {
                    copy($sourcePath, $destinationPath);
                }

                // Save relative path to DB (relative to storage/app/public)
                $imagePath = 'image/' . $imageFilename;
            }
        }

        Product::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? '',
            'price' => floatval($data['price']),
            'sell_price' => isset($data['sell_price']) ? floatval($data['sell_price']) : null,
            'marge' => isset($data['marge']) ? floatval($data['marge']) : null,
            'stock' => isset($data['stock']) ? intval($data['stock']) : 0,
            'categorie_id' => isset($data['categorie_id']) ? intval($data['categorie_id']) : null,
            'image' => $imagePath,
            'status' => $data['status'] ?? 'active',
        ]);
    }

    return response()->json(['message' => 'Products imported successfully']);
}
public function showProducts(){
    $product = Product::where('status','active')->get();
    return response()->json($product);
}
public function showProductDetails(int $id){
    $product = Product::findOrFail($id);
    return response()->json($product);
}

}
