<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createCategory(Request $request){
        $request->validate([
            'name' => 'required|string|min:5',
            'description' => 'required|string|min:20'
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
        return response()->json($category);
    }
}
