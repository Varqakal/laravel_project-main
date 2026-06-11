<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->with(['category', 'images']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::active()->withCount(['products' => fn($q) => $q->active()])->get();
        $currentCategory = $request->filled('category')
            ? Category::find($request->category)
            : null;

        return view('products.index', compact('products', 'categories', 'currentCategory'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'images']);

        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('images')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
