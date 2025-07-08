<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function createCategory(Request $request){
        $request->validate([
            'name' => 'required|string|min:5|not_regex:/<[^>]*>/',
            'description' => 'required|string|min:20|not_regex:/<[^>]*>/'
        ]);

        $category = Category::create([
            'name'=>$request->name,
            'description' => $request->description
        ]);
        return response()->json([
            'category' => $category,
        ], 201);
    }
    public function show(){
        $category = Category::all();
        Log::info('this is category',$category);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);

            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json([
                'message' => 'Category updated successfully',
                'category' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update category',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
