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
                                {{--{{ $banner->subtitle ?? '' }} --}}
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
                                <x-whatsapp-button label="Commander" class="btn btn-whatsapp btn-lg px-4 justify-content-center" />
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
                    <div class="col-md-6">
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
                    <x-whatsapp-button label="Commander via WhatsApp" class="btn btn-whatsapp btn-lg w-100 mb-3 justify-content-center" />
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
