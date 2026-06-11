@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

{{-- ── Hero Carousel ──────────────────────────────────────── --}}
@if($banners->isNotEmpty())
<div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="5500">
    <div class="carousel-inner">
        @foreach($banners as $i => $banner)
        <div class="carousel-item @if($i === 0) active @endif">
            <div class="container">
                <div class="row align-items-center hero-row">
                    <div class="col-md-6">
                        <div class="carousel-caption">
                            <p class="hero-eyebrow">
                                {{ $banner->subtitle ?? 'Nouveautés &amp; Offres' }}
                            </p>
                            <h2>{{ $banner->title ?? 'Les meilleurs appareils électroniques' }}</h2>
                            <p>Découvrez notre sélection de produits testés et certifiés — livrés rapidement à Kinshasa.</p>
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                @if($banner->button_url)
                                    <a href="{{ $banner->button_url }}" class="btn btn-primary btn-lg px-4">
                                        {{ $banner->button_text ?? 'Voir la collection' }}
                                    </a>
                                @else
                                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-4">
                                        {{ $banner->button_text ?? 'Voir la collection' }}
                                    </a>
                                @endif
                                <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-4">
                                    Commander
                                </a>
                            </div>
                            {{-- Micro-proof --}}
                            <div class="d-flex gap-3 mt-4 flex-wrap" style="font-size:.8rem;color:var(--text-secondary);">
                                <span style="display:flex;align-items:center;gap:5px;">
                                    <span style="color:var(--primary);font-weight:700;">&#10003;</span> Produits certifiés
                                </span>
                                <span style="display:flex;align-items:center;gap:5px;">
                                    <span style="color:var(--primary);font-weight:700;">&#10003;</span> Réponse sous 24h
                                </span>
                                <span style="display:flex;align-items:center;gap:5px;">
                                    <span style="color:var(--primary);font-weight:700;">&#10003;</span> Livraison Kinshasa
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none d-md-block">
                        @if($banner->image)
                            <div class="hero-img-wrap">
                                <img src="{{ $banner->imageUrl }}" alt="{{ $banner->title }}">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if($banners->count() > 1)
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
    @endif
</div>
@endif

{{-- ── Trust Strip ─────────────────────────────────────────── --}}
<div class="trust-strip">
    <div class="container">
        <div class="row g-2 g-md-0 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="trust-item">
                    <div class="trust-icon">&#10003;</div>
                    <div><strong>Produits vérifiés</strong> <span class="label">par nos experts</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="trust-item">
                    <div class="trust-icon" style="background:rgba(16,185,129,.1);border-color:rgba(16,185,129,.2);color:#10b981;">24h</div>
                    <div><strong>Réponse garantie</strong> <span class="label">sous 24h</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="trust-item">
                    <div class="trust-icon" style="background:rgba(245,158,11,.1);border-color:rgba(245,158,11,.2);color:#f59e0b;">1K+</div>
                    <div><strong>Clients satisfaits</strong> <span class="label">à Kinshasa</span></div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="trust-item">
                    <div class="trust-icon" style="background:rgba(124,111,255,.1);border-color:rgba(124,111,255,.2);color:var(--accent);">&#9679;</div>
                    <div><strong>Stock disponible</strong> <span class="label">en temps réel</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Stats Bar ────────────────────────────────────────────── --}}
<div class="stats-bar">
    <div class="container">
        <div class="row align-items-center text-center g-4">
            <div class="col-6 col-md-3">
                <div class="stat-num" data-counter="500">0</div>
                <div class="stat-label">Produits en stock</div>
            </div>
            <div class="col-md-auto d-none d-md-block stat-divider"></div>
            <div class="col-6 col-md-3">
                <div class="stat-num" data-counter="1000">0</div>
                <div class="stat-label">Clients satisfaits</div>
            </div>
            <div class="col-md-auto d-none d-md-block stat-divider"></div>
            <div class="col-6 col-md-3">
                <div class="stat-num" data-counter="5">0</div>
                <div class="stat-label">Années d'expérience</div>
            </div>
            <div class="col-md-auto d-none d-md-block stat-divider"></div>
            <div class="col-6 col-md-2">
                <div class="stat-num">24h</div>
                <div class="stat-label">Délai de réponse</div>
            </div>
        </div>
    </div>
</div>

{{-- ── Catégories ──────────────────────────────────────────── --}}
@if($categories->isNotEmpty())
<section class="py-5">
    <div class="container">
        <h2 class="section-title reveal">Nos Catégories</h2>
        <p class="section-subtitle reveal">Trouvez exactement ce que vous cherchez parmi nos catégories soigneusement sélectionnées.</p>
        <div class="row row-cols-2 row-cols-md-4 g-3">
            @foreach($categories as $i => $category)
            <div class="col reveal reveal-delay-{{ min($i + 1, 4) }}">
                <a href="{{ route('categories.show', $category->slug) }}" class="category-card d-block">
                    <img src="{{ $category->imageUrl }}" alt="{{ $category->name }}" loading="lazy">
                    <div class="cat-overlay">
                        <div class="cat-name">{{ $category->name }}</div>
                        <div class="cat-count">{{ $category->products_count }} produit(s)</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── Produits par catégorie ───────────────────────────────── --}}
@if($productsByCategory->isNotEmpty())
<section class="py-5 bg-light">
    <div class="container" x-data="{ tab: {{ $productsByCategory->first()?->id ?? 0 }} }">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-2 reveal">
            <h2 class="section-title mb-0">Nos Produits</h2>
            <div class="d-flex gap-2 flex-wrap">
                @foreach($productsByCategory as $cat)
                    <button class="tab-btn"
                            :class="tab === {{ $cat->id }} ? 'active' : ''"
                            @click="tab = {{ $cat->id }}">
                        {{ $cat->name }}
                    </button>
                @endforeach
            </div>
        </div>
        <p class="section-subtitle reveal">Choisissez votre catégorie et explorez notre sélection exclusive.</p>

        @foreach($productsByCategory as $cat)
        <div x-show="tab === {{ $cat->id }}"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0">
            @if($cat->products->isNotEmpty())
                <div class="row row-cols-2 row-cols-md-4 g-3">
                    @foreach($cat->products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('categories.show', $cat->slug) }}" class="btn btn-outline-primary px-4">
                        Voir tous — {{ $cat->name }}
                    </a>
                </div>
            @endif
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ── Produits en vedette ──────────────────────────────────── --}}
@if($featuredProducts->isNotEmpty())
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-2 reveal">
            <h2 class="section-title mb-0">Produits en Vedette</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">Voir tout</a>
        </div>
        <p class="section-subtitle reveal">Nos meilleurs produits, choisis pour leur qualité et leur rapport prix/performance exceptionnel.</p>
        <div class="row row-cols-2 row-cols-md-4 g-3 reveal">
            @foreach($featuredProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── Meilleures Offres ────────────────────────────────────── --}}
@if($hotProducts->isNotEmpty())
<section class="hot-section">
    <div class="container">
        <div class="mb-4 reveal">
            <div class="urgency-pill">
                <span class="urgency-dot"></span>
                Offres exclusives
            </div>
            <h2 class="section-title mb-1">Meilleures Offres du Moment</h2>
            <p class="section-subtitle">Ces prix exceptionnels sont disponibles pour une durée limitée. Ne les manquez pas.</p>
        </div>
        <div class="row row-cols-2 row-cols-md-4 g-3 reveal">
            @foreach($hotProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── Témoignage ───────────────────────────────────────────── --}}
<section class="py-5" style="background:var(--bg-surface);border-top:1px solid var(--border);border-bottom:1px solid var(--border);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center reveal">
                <p class="hero-eyebrow d-inline-block mb-4">Ce que disent nos clients</p>
                <blockquote style="font-size:1.1rem;color:var(--text-secondary);line-height:1.85;font-style:italic;margin:0 0 28px;">
                    "J'avais besoin d'un laptop pour mon travail de comptabilité. La commande a été traitée le matin même, livré dans l'après-midi à Lemba. L'appareil était emballé proprement et correspond exactement à ce qui était affiché. Je suis revenu pour acheter un smartphone un mois après."
                </blockquote>
                <div style="display:flex;align-items:center;justify-content:center;gap:12px;">
                    <div style="width:46px;height:46px;border-radius:50%;background:linear-gradient(135deg,#088178,#0bbfb4);display:flex;align-items:center;justify-content:center;font-weight:800;color:#fff;font-size:.95rem;">BK</div>
                    <div style="text-align:left;">
                        <div style="color:var(--text-primary);font-weight:700;font-size:.9rem;">Bienvenu K.</div>
                        <div style="color:var(--text-muted);font-size:.8rem;">Lemba, Kinshasa &mdash; achat vérifié</div>
                    </div>
                    <div style="margin-left:8px;color:#f59e0b;font-size:1rem;letter-spacing:2px;">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── CTA Final ────────────────────────────────────────────── --}}
<section class="cta-section">
    <div class="container">
        <div class="row align-items-center g-5">
            {{-- Left: copy + benefits --}}
            <div class="col-lg-6 cta-col-left reveal">
                <p class="hero-eyebrow d-inline-block mb-3">Passez votre commande aujourd'hui</p>
                <h3 class="mb-3">Prêt à recevoir votre produit idéal ?</h3>
                <p style="color:var(--text-secondary);margin-bottom:28px;max-width:420px;">
                    Des milliers de clients nous font confiance à Kinshasa. Contactez-nous maintenant et obtenez une réponse personnalisée sous 24h.
                </p>
                <div class="mb-2 cta-benefit">Conseils personnalisés par nos experts</div>
                <div class="mb-2 cta-benefit">Prix compétitifs et transparents</div>
                <div class="mb-2 cta-benefit">Livraison rapide à votre adresse</div>
                <div class="mb-4 cta-benefit">Suivi de commande en temps réel</div>
            </div>
            {{-- Right: action --}}
            <div class="col-lg-6 reveal">
                <div class="p-4 rounded-4" style="background:var(--bg-card);border:1px solid var(--border);">
                    <h5 class="fw-bold mb-1" style="color:var(--text-primary);">Contactez-nous maintenant</h5>
                    <p style="color:var(--text-muted);font-size:.88rem;margin-bottom:20px;">
                        Choisissez votre mode de contact préféré
                    </p>
                    @php
                        $waPhone = preg_replace('/[^0-9]/', '', env('CONTACT_WHATSAPP', env('WHATSAPP_PHONE', '')));
                    @endphp
                    @if($waPhone)
                    <a href="https://wa.me/{{ $waPhone }}"
                       target="_blank"
                       class="btn btn-whatsapp btn-lg w-100 mb-3">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Commander via WhatsApp
                    </a>
                    @endif
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg w-100 mb-3">
                        Formulaire de commande
                    </a>
                    <p style="text-align:center;color:var(--text-muted);font-size:.8rem;margin:0;">
                        Gratuit · Sans engagement · Réponse sous 24h
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
/* Scroll reveal */
(function () {
    const els = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
    }, { threshold: 0.12 });
    els.forEach(el => io.observe(el));
})();

/* Animated counters */
(function () {
    const counters = document.querySelectorAll('[data-counter]');
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (!e.isIntersecting) return;
            const el = e.target;
            const target = parseInt(el.dataset.counter);
            const suffix = target >= 1000 ? '+' : '+';
            let start = 0;
            const step = Math.ceil(target / 60);
            const timer = setInterval(() => {
                start += step;
                if (start >= target) { el.textContent = target + suffix; clearInterval(timer); return; }
                el.textContent = start + suffix;
            }, 20);
            io.unobserve(el);
        });
    }, { threshold: 0.5 });
    counters.forEach(c => io.observe(c));
})();
</script>
@endsection
