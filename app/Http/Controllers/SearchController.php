<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim(mb_substr($request->get('q', ''), 0, 150));
        $categoryId = $request->integer('category') ?: null;

        $products = Product::active()
            ->when($query, fn($q) => $q->where(function ($inner) use ($query) {
                $inner->where('name', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
            }))
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->with(['category', 'images'])
            ->paginate(12)
            ->withQueryString();

        $categories = Category::active()->get();

        return view('search', compact('products', 'query', 'categories', 'categoryId'));
    }
}
