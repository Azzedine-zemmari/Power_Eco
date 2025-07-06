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
            'name' => [
                'required',
                'string',
                'min:5',
                'max:100',
                'regex:/^[\pL\pN\s\-_.]+$/u'
            ],
            'description' => 'required|string|min:20',
            'price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric',
            'marge' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'required|integer|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive'
        ], [
            'name.regex' => 'The name may only contain letters, numbers, spaces, dashes, underscores, and periods.'
        ]);

        // Sanitize all text input
        $name = strip_tags(trim($request->name));
        $description = strip_tags(trim($request->description));
        $status = strip_tags(trim($request->status));

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath =  $request->file('image')->store('image','public');
        }
        $product = Product::create([
            'name' => $name,
            'description' => $description,
            'price' => $request->price,
            'stock' => $request->stock,
            'categorie_id' => $request->categorie_id,
            'image' => $imagePath,
            'status' => $status,
            'sell_price' => $request->sell_price,
            'marge' => $request->marge
        ]);
        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);
    }
    // this function for the user to see the data with some advanced filters
    public function show(Request $request){
        $perPage = $request->get('per_page', 6);
        $query = Product::query()->where('status', 'active');

        // Search filter
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Category filter
        if ($request->has('category')) {
            $query->where('categorie_id', $request->category);
        }

        // Price range filter
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->paginate($perPage);
        return response()->json($products);
    }
    // this show for product manager
    public function ProductShow(){
        $product = Product::all();
        return response()->json($product);
    }
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:5',
                'max:100',
                'regex:/^[\pL\pN\s\-_.]+$/u'
            ],
            'description' => 'required|string|min:20',
            'price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric',
            'marge' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ], [
            'name.regex' => 'The name may only contain letters, numbers, spaces, dashes, underscores, and periods.'
        ]);

        $product = Product::findOrFail($id);

        // Sanitize all text input
        $name = strip_tags(trim($request->name));
        $description = strip_tags(trim($request->description));
        $status = strip_tags(trim($request->status));

        if ($request->hasFile('image')) {
            // Optionally delete old image here
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('image', 'public');
            $product->image = $imagePath;
        }

        $product->name = $name;
        $product->description = $description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->categorie_id = $request->categorie_id;
        $product->status = $status;
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
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:10240', // 10MB
        ]);

        $errors = [];
        $imported = 0;
        $file = $request->file('excel_file');

        try {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();
            if (empty($rows) || count($rows) < 2) {
                return response()->json(['success' => false, 'errors' => ['The file is empty or missing a header row.']], 422);
            }
            $header = array_map('strtolower', $rows[0]);
            unset($rows[0]);

            $imageSourceFolder = 'C:/Users/azzed/images/';
            foreach ($rows as $i => $row) {
                $rowNumber = $i + 1; // +1 for header and 0-index
                $data = array_combine($header, $row);

                // Validate required fields
                if (empty($data['name']) || empty($data['price'])) {
                    $errors[] = "Row $rowNumber: Name and price are required.";
                    continue;
                }
                if (!is_numeric($data['price']) || $data['price'] < 0) {
                    $errors[] = "Row $rowNumber: Invalid price value.";
                    continue;
                }
                if (isset($data['sell_price']) && (!is_numeric($data['sell_price']) || $data['sell_price'] < 0)) {
                    $errors[] = "Row $rowNumber: Invalid sell_price value.";
                    continue;
                }
                if (isset($data['marge']) && (!is_numeric($data['marge']) || $data['marge'] < 0)) {
                    $errors[] = "Row $rowNumber: Invalid marge value.";
                    continue;
                }
                if (isset($data['stock']) && (!is_numeric($data['stock']) || $data['stock'] < 0)) {
                    $errors[] = "Row $rowNumber: Invalid stock value.";
                    continue;
                }
                if (empty($data['categorie_id']) || !\App\Models\Category::find($data['categorie_id'])) {
                    $errors[] = "Row $rowNumber: Category ID '{$data['categorie_id']}' does not exist.";
                    continue;
                }
                // Sanitize name and description
                $name = strip_tags($data['name']);
                $description = isset($data['description']) ? strip_tags($data['description']) : '';

                // Validate image
                $imagePath = null;
                if (!empty($data['image'])) {
                    $imageFilename = basename($data['image']); // Prevent path traversal
                    $sourcePath = $imageSourceFolder . $imageFilename;
                    if (!file_exists($sourcePath)) {
                        $errors[] = "Row $rowNumber: Image '{$imageFilename}' not found in source folder.";
                        continue;
                    }
                    $destinationPath = storage_path('app/public/image/' . $imageFilename);
                    if (!file_exists($destinationPath)) {
                        copy($sourcePath, $destinationPath);
                    }
                    $imagePath = 'image/' . $imageFilename;
                }

                // Only allow 'active' or 'inactive' for status
                $status = isset($data['status']) && in_array(strtolower($data['status']), ['active', 'inactive']) ? strtolower($data['status']) : 'active';

                // Insert product
                \App\Models\Product::create([
                    'name' => $name,
                    'description' => $description,
                    'price' => floatval($data['price']),
                    'sell_price' => isset($data['sell_price']) ? floatval($data['sell_price']) : null,
                    'marge' => isset($data['marge']) ? floatval($data['marge']) : null,
                    'stock' => isset($data['stock']) ? intval($data['stock']) : 0,
                    'categorie_id' => intval($data['categorie_id']),
                    'image' => $imagePath,
                    'status' => $status,
                ]);
                $imported++;
            }
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'errors' => ['Import failed. Please check your file format.']], 500);
        }

        if ($errors) {
            return response()->json(['success' => false, 'errors' => $errors, 'imported' => $imported], 422);
        }
        return response()->json(['success' => true, 'imported' => $imported, 'message' => 'Products imported successfully']);
    }
    public function showProducts(){
        $product = Product::where('status','active')->get();
        return response()->json($product);
    }
    public function showProductDetails(int $id){
        $product = Product::findOrFail($id);
        
        // Get related products from the same category
        $relatedProducts = Product::where('categorie_id', $product->categorie_id)
            ->where('id', '!=', $id) // Exclude current product
            ->where('status', 'active')
            ->take(4)
            ->get();
        
        return response()->json([
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]);
    }

    public function getFeaturedProducts()
    {
        $featuredProducts = Product::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
        
        return response()->json($featuredProducts);
    }

}
