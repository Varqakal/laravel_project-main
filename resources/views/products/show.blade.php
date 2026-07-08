@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('categories.show', $product->category->slug) }}">
                    {{ $product->category->name }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        {{-- Galerie --}}
        <div class="col-md-5"
             x-data="{ mainImage: '{{ $product->imageUrl }}' }">
            <img :src="mainImage" alt="{{ $product->name }}" class="main-product-img mb-3">
            @if($product->images->isNotEmpty())
            <div class="d-flex gap-2 flex-wrap">
                @foreach($product->images as $img)
                <img src="{{ $img->url }}"
                     alt="{{ $product->name }}"
                     class="thumb-img {{ $img->is_primary ? 'active' : '' }}"
                     @click="mainImage = '{{ $img->url }}'">
                @endforeach
            </div>
            @endif
        </div>

        {{-- Infos produit --}}
        <div class="col-md-7">
            @if($product->badge)
                <span class="badge badge-{{ $product->badge }} mb-2" style="font-size:.8rem; padding:4px 10px;">
                    {{ strtoupper($product->badge) }}
                </span>
            @endif
            <p class="text-muted small mb-1">{{ $product->category->name }}</p>
            <h1 class="fs-3 fw-bold mb-3">{{ $product->name }}</h1>

            <div class="d-flex align-items-center gap-3 mb-4">
                <span class="price-new fs-3">${{ number_format($product->price, 2) }}</span>
                @if($product->old_price)
                    <span class="price-old fs-5">${{ number_format($product->old_price, 2) }}</span>
                    <span class="badge bg-danger">
                        -{{ $product->discountPercent }}%
                    </span>
                @endif
            </div>

            @if($product->description)
            <div class="mb-4">
                <h6 class="fw-bold" style="color:var(--text-primary);">Description</h6>
                <p style="color:var(--text-secondary);line-height:1.75;">{{ $product->description }}</p>
            </div>
            @endif

            <div class="d-flex flex-wrap gap-3 mt-3">
                <x-whatsapp-button :product="$product" label="Commander ce produit" class="btn btn-whatsapp btn-lg px-5 justify-content-center" />
                <a href="{{ route('contact') }}?product_id={{ $product->id }}" class="btn btn-outline-primary btn-lg">
                    Nous contacter
                </a>
            </div>

            <div class="mt-4 p-3 rounded-3 d-flex flex-wrap gap-3" style="background:rgba(var(--primary-rgb),.06);border:1px solid rgba(var(--primary-rgb),.12);">
                <span style="color:var(--text-secondary);font-size:.85rem;display:flex;align-items:center;gap:6px;">
                    <span style="color:var(--primary);font-weight:900;font-size:.7rem;">&#10003;</span> Livraison Kinshasa
                </span>
                <span style="color:var(--border);">|</span>
                <span style="color:var(--text-secondary);font-size:.85rem;display:flex;align-items:center;gap:6px;">
                    <span style="color:var(--primary);font-weight:900;font-size:.7rem;">&#10003;</span> Produit vérifié
                </span>
                <span style="color:var(--border);">|</span>
                <span style="color:var(--text-secondary);font-size:.85rem;display:flex;align-items:center;gap:6px;">
                    <span style="color:var(--primary);font-weight:900;font-size:.7rem;">&#10003;</span> Réponse sous 24h
                </span>
            </div>
        </div>
    </div>

    {{-- Produits similaires --}}
    @if($relatedProducts->isNotEmpty())
    <section class="mt-5 pt-4 border-top">
        <h4 class="section-title">Produits similaires</h4>
        <div class="row row-cols-2 row-cols-md-4 g-3">
            @foreach($relatedProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
