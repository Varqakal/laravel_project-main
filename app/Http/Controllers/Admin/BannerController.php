<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('sort_order')->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'nullable|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'button_url'  => ['nullable', 'string', 'max:255', function ($attr, $value, $fail) {
                if ($value && !preg_match('/^(https?:\/\/|\/)/', $value)) {
                    $fail('Le lien doit commencer par / ou https://');
                }
            }],
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'sort_order'  => 'integer|min:0',
            'is_active'   => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('banners', 'public');
        }

        Banner::create($validated);

        return redirect()->route('admin.bannieres.index')
            ->with('success', 'Bannière créée avec succès.');
    }

    public function show(Banner $banniere)
    {
        return redirect()->route('admin.bannieres.edit', $banniere);
    }

    public function edit(Banner $banniere)
    {
        return view('admin.banners.edit', ['banner' => $banniere]);
    }

    public function update(Request $request, Banner $banniere)
    {
        $validated = $request->validate([
            'title'       => 'nullable|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'button_url'  => ['nullable', 'string', 'max:255', function ($attr, $value, $fail) {
                if ($value && !preg_match('/^(https?:\/\/|\/)/', $value)) {
                    $fail('Le lien doit commencer par / ou https://');
                }
            }],
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'sort_order'  => 'integer|min:0',
            'is_active'   => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            if ($banniere->image) {
                Storage::disk('public')->delete($banniere->image);
            }
            $validated['image'] = $request->file('image')->store('banners', 'public');
        }

        $banniere->update($validated);

        return redirect()->route('admin.bannieres.index')
            ->with('success', 'Bannière mise à jour avec succès.');
    }

    public function destroy(Banner $banniere)
    {
        if ($banniere->image) {
            Storage::disk('public')->delete($banniere->image);
        }
        $banniere->delete();

        return redirect()->route('admin.bannieres.index')
            ->with('success', 'Bannière supprimée avec succès.');
    }
}
