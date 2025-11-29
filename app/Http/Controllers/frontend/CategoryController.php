<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show category with subcategories
    public function show($id)
    {
        // Get the category with its subcategories
       $category = Category::with('subcategory.course')->findOrFail($id);



        return view('frontend.pages.category.show', compact('category'));
    }
}
