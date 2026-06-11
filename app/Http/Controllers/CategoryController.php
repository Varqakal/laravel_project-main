<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->products()
            ->active()
            ->with('images')
            ->paginate(12);

        $categories = Category::active()->withCount(['products' => fn($q) => $q->active()])->get();

        return view('categories.show', compact('category', 'products', 'categories'));
    }
}
