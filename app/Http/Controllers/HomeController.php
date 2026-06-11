<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->get();
        $categories = Category::active()->withCount('products')->get();

        $newProducts = Product::active()->new()
            ->with(['category', 'images'])
            ->latest()->take(8)->get();

        $featuredProducts = Product::active()->featured()
            ->with(['category', 'images'])
            ->take(8)->get();

        $hotProducts = Product::active()->hot()
            ->with(['category', 'images'])
            ->take(4)->get();

        $productsByCategory = Category::active()
            ->with(['products' => fn($q) => $q->active()->with('images')->take(4)])
            ->get();

        return view('home', compact(
            'banners', 'categories', 'newProducts',
            'featuredProducts', 'hotProducts', 'productsByCategory'
        ));
    }
}
