@extends('layouts.app')

@section('title', $category->name)

@section('content')

{{-- ── En-tête de catégorie ───────────────────────────────── --}}
<div style="background:linear-gradient(135deg,var(--bg-base) 0%,var(--hero-gradient-end) 100%);border-bottom:1px solid var(--border);padding:36px 0 0;">
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb" style="margin:0;font-size:.82rem;">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produits</a></li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ol>
        </nav>
        <div class="pb-4">
            <h1 class="fw-bold mb-1" style="font-size:clamp(1.35rem,3vw,1.9rem);letter-spacing:-.3px;color:var(--text-primary);">
                {{ $category->name }}
            </h1>
            <p style="color:var(--text-secondary);font-size:.88rem;margin:0;">
                {{ $products->total() }} produit{{ $products->total() > 1 ? 's' : '' }} disponible{{ $products->total() > 1 ? 's' : '' }}
            </p>
        </div>

        {{-- Filtres catégories (mobile) --}}
        <div class="d-lg-none prod-mobile-tabs">
            <a href="{{ route('products.index') }}" class="cat-tab-pill">Tous</a>
            @foreach($categories as $cat)
            <a href="{{ route('categories.show', $cat->slug) }}"
               class="cat-tab-pill {{ $cat->id === $category->id ? 'active' : '' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>
</div>

<div class="container py-4 py-lg-5">
    <div class="row g-4">

        {{-- Sidebar desktop ─────────────────────────────────── --}}
        <div class="col-lg-3 d-none d-lg-block">
            <div style="position:sticky;top:82px;">
                <div class="card border-0 shadow-sm" style="overflow:hidden;">
                    <div style="padding:13px 18px;border-bottom:1px solid var(--border);">
                        <span style="font-size:.71rem;text-transform:uppercase;letter-spacing:1.8px;color:var(--text-muted);font-weight:700;">Catégories</span>
                    </div>
                    <ul style="list-style:none;padding:6px 0;margin:0;">
                        <li>
                            <a href="{{ route('products.index') }}" class="cat-sidebar-link">
                                <span>Tous les produits</span>
                            </a>
                        </li>
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('categories.show', $cat->slug) }}"
                               class="cat-sidebar-link {{ $cat->id === $category->id ? 'is-active' : '' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="cat-sidebar-count">{{ $cat->products_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-3 p-3 rounded-3" style="background:linear-gradient(135deg,rgba(var(--primary-rgb),.08),rgba(var(--accent-rgb),.04));border:1px solid rgba(var(--primary-rgb),.15);">
                    <p style="color:var(--text-secondary);font-size:.82rem;line-height:1.55;margin:0 0 10px;">
                        Vous ne trouvez pas ce que vous cherchez ? Contactez-nous directement.
                    </p>
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-sm w-100">
                        Nous contacter
                    </a>
                </div>
            </div>
        </div>

        {{-- Grille produits ─────────────────────────────────── --}}
        <div class="col-lg-9">
            @if($products->isNotEmpty())
                <div class="row row-cols-2 row-cols-md-3 g-3">
                    @foreach($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div style="width:72px;height:72px;border-radius:20px;background:rgba(var(--primary-rgb),.07);border:1px solid rgba(var(--primary-rgb),.14);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/>
                        </svg>
                    </div>
                    <h5 style="color:var(--text-primary);font-weight:700;margin-bottom:8px;">Aucun produit pour le moment</h5>
                    <p style="color:var(--text-muted);font-size:.9rem;max-width:300px;margin:0 auto 20px;line-height:1.6;">
                        Cette catégorie ne contient pas encore de produits. Revenez bientôt.
                    </p>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                        Voir tous les produits
                    </a>
                </div>
            @endif
        </div>

    </div>
</div>

@endsection
