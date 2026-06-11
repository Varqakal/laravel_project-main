@extends('layouts.admin')

@section('title', 'Produits')
@section('page-title', 'Gestion des Produits')

@section('content')
@include('partials.flash')

<div class="d-flex justify-content-between align-items-center mb-4">
    <form action="" method="GET" class="d-flex gap-2">
        <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="">Toutes catégories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        <select name="badge" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="">Tous les badges</option>
            <option value="new" {{ request('badge') === 'new' ? 'selected' : '' }}>NEW</option>
            <option value="hot" {{ request('badge') === 'hot' ? 'selected' : '' }}>HOT</option>
            <option value="sale" {{ request('badge') === 'sale' ? 'selected' : '' }}>SALE</option>
        </select>
    </form>
    <a href="{{ route('admin.produits.create') }}" class="btn btn-primary">+ Ajouter un produit</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                    <th>Badge</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" width="50" height="50"
                                 style="object-fit:cover; border-radius:6px;">
                        @else
                            <div style="width:50px;height:50px;background:#eee;border-radius:6px;"></div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-bold">{{ $product->name }}</div>
                        <small class="text-muted">/produits/{{ $product->slug }}</small>
                    </td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <span class="fw-bold text-primary">${{ number_format($product->price, 2) }}</span>
                        @if($product->old_price)
                            <br><small class="text-muted price-old">${{ number_format($product->old_price, 2) }}</small>
                        @endif
                    </td>
                    <td>
                        @if($product->badge)
                            <span class="badge badge-{{ $product->badge }}">{{ strtoupper($product->badge) }}</span>
                        @endif
                        @if($product->is_featured)
                            <span class="badge bg-info ms-1">Vedette</span>
                        @endif
                    </td>
                    <td>
                        @if($product->is_active)
                            <span class="badge bg-success">Actif</span>
                        @else
                            <span class="badge bg-secondary">Inactif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.produits.edit', $product) }}"
                           class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form action="{{ route('admin.produits.destroy', $product) }}" method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Supprimer ce produit ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">Aucun produit.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $products->links() }}</div>
@endsection
