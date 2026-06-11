<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->latest();

        if ($request->filled('category')) {
            $query->where('category_id', (int) $request->category);
        }
        if ($request->filled('badge') && in_array($request->badge, ['new', 'hot', 'sale'])) {
            $query->where('badge', $request->badge);
        }

        $products = $query->paginate(15)->withQueryString();
        $categories = Category::active()->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'old_price'   => 'nullable|numeric|min:0',
            'badge'       => 'nullable|in:new,hot,sale',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'sort_order'  => 'integer|min:0',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active', true);

        $product = Product::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                $isPrimary = $index === 0;

                $product->images()->create([
                    'image_path' => $path,
                    'is_primary' => $isPrimary,
                    'sort_order' => $index,
                ]);

                if ($isPrimary) {
                    $product->update(['image' => $path]);
                }
            }
        }

        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit créé avec succès.');
    }

    public function show(Product $produit)
    {
        return redirect()->route('admin.produits.edit', $produit);
    }

    public function edit(Product $produit)
    {
        $categories = Category::active()->get();
        $produit->load('images');
        return view('admin.products.edit', ['product' => $produit, 'categories' => $categories]);
    }

    public function update(Request $request, Product $produit)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'old_price'   => 'nullable|numeric|min:0',
            'badge'       => 'nullable|in:new,hot,sale',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'sort_order'  => 'integer|min:0',
            'images'      => 'nullable|array',
            'images.*'    => 'image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active', true);

        $produit->update($validated);

        if ($request->hasFile('images')) {
            $existingCount = $produit->images()->count();
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('products', 'public');
                $isPrimary = $existingCount === 0 && $index === 0;

                $produit->images()->create([
                    'image_path' => $path,
                    'is_primary' => $isPrimary,
                    'sort_order' => $existingCount + $index,
                ]);

                if ($isPrimary) {
                    $produit->update(['image' => $path]);
                }
            }
        }

        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Product $produit)
    {
        foreach ($produit->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }
        if ($produit->image) {
            Storage::disk('public')->delete($produit->image);
        }
        $produit->delete();

        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit supprimé avec succès.');
    }

    public function destroyImage(Product $product, ProductImage $image)
    {
        Storage::disk('public')->delete($image->image_path);

        if ($image->is_primary) {
            $next = $product->images()->where('id', '!=', $image->id)->first();
            if ($next) {
                $next->update(['is_primary' => true]);
                $product->update(['image' => $next->image_path]);
            } else {
                $product->update(['image' => null]);
            }
        }

        $image->delete();

        return response()->json(['success' => true]);
    }
}
