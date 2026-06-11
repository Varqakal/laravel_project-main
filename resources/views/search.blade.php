@extends('layouts.app')

@section('title', 'Recherche' . ($query ? ' : ' . $query : ''))

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <form action="{{ route('search') }}" method="GET">
            <div class="input-group search-bar" style="max-width:600px;">
                <select name="category" class="form-select" style="max-width:180px;">
                    <option value="">Toutes catégories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <input type="text" name="q" class="form-control"
                       value="{{ $query }}" placeholder="Rechercher un produit...">
                <button class="input-group-text" type="submit">Rechercher</button>
            </div>
        </form>
    </div>

    @if($query)
        <h5 class="mb-4">
            {{ $products->total() }} résultat(s) pour
            <strong>« {{ $query }} »</strong>
        </h5>
    @endif

    @if($products->isNotEmpty())
        <div class="row row-cols-2 row-cols-md-4 g-3">
            @foreach($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
        <div class="mt-4">{{ $products->links() }}</div>
    @else
        <div class="text-center py-5">
            <p class="fs-5 text-muted">Aucun produit trouvé pour votre recherche.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-2">
                Voir tous les produits
            </a>
        </div>
    @endif
</div>
@endsection
