<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products'   => Product::count(),
            'categories' => Category::count(),
            'messages'   => ContactMessage::count(),
            'unread'     => ContactMessage::unread()->count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->with('product')->get();
        $recentProducts = Product::latest()->take(5)->with('category')->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProducts'));
    }
}
