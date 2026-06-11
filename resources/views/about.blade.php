@extends('layouts.app')

@section('title', 'À propos')

@section('content')
<div class="page-hero text-center">
    <div class="container">
        <h1 class="fw-bold display-5 mb-3">À propos de nous</h1>
        <p style="max-width:600px; margin:0 auto; color:rgba(255,255,255,.75);">
            Votre partenaire de confiance pour les appareils électroniques de qualité à Kinshasa.
        </p>
    </div>
</div>

<div class="container py-5">

    {{-- Mission + Stats --}}
    <div class="row g-5 align-items-center mb-5">
        <div class="col-md-6">
            <h2 class="section-title">Notre mission</h2>
            <p style="color:var(--text-secondary); line-height:1.8;">
                Chez <strong style="color:var(--text-primary);">Electro Vitrine</strong>, nous avons pour mission de vous offrir
                les meilleurs appareils électroniques — laptops, smartphones, caméras et accessoires — à des prix
                compétitifs, avec un service client irréprochable.
            </p>
            <p style="color:var(--text-secondary); line-height:1.8;">
                Depuis notre création, nous nous engageons à proposer uniquement des produits sélectionnés
                avec soin pour répondre aux besoins de notre clientèle à Kinshasa et au-delà.
            </p>
            <a href="{{ route('contact') }}" class="btn btn-primary mt-2">
                Nous contacter
            </a>
        </div>
        <div class="col-md-6">
            <div class="row g-3">
                <div class="col-6">
                    <div class="text-center p-4 rounded" style="background:rgba(0,212,170,.09);border:1px solid rgba(0,212,170,.22);">
                        <div class="fw-900" style="color:var(--primary);font-size:2.4rem;letter-spacing:-2px;line-height:1;">500+</div>
                        <div style="color:var(--text-secondary);font-size:.85rem;margin-top:6px;font-weight:500;">Produits disponibles</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-center p-4 rounded" style="background:rgba(239,68,68,.09);border:1px solid rgba(239,68,68,.22);">
                        <div class="fw-900" style="color:#ef4444;font-size:2.4rem;letter-spacing:-2px;line-height:1;">1000+</div>
                        <div style="color:var(--text-secondary);font-size:.85rem;margin-top:6px;font-weight:500;">Clients satisfaits</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-center p-4 rounded" style="background:rgba(124,111,255,.09);border:1px solid rgba(124,111,255,.22);">
                        <div class="fw-900" style="color:var(--accent);font-size:2.4rem;letter-spacing:-2px;line-height:1;">5+</div>
                        <div style="color:var(--text-secondary);font-size:.85rem;margin-top:6px;font-weight:500;">Ans d'expérience</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="text-center p-4 rounded" style="background:rgba(245,158,11,.09);border:1px solid rgba(245,158,11,.22);">
                        <div class="fw-900" style="color:#f59e0b;font-size:2.4rem;letter-spacing:-2px;line-height:1;">24h</div>
                        <div style="color:var(--text-secondary);font-size:.85rem;margin-top:6px;font-weight:500;">Réponse garantie</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Nos valeurs --}}
    <div class="row g-4 mb-5">
        <div class="col-12">
            <h2 class="section-title text-center mb-1">Nos valeurs</h2>
            <p class="text-center section-subtitle mx-auto">Ce qui nous distingue et guide chacune de nos actions au quotidien.</p>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded h-100" style="background:var(--bg-card);border:1px solid var(--border);">
                <span class="val-num">01</span>
                <h5 class="fw-bold mb-2" style="color:var(--text-primary);">Qualité garantie</h5>
                <p style="color:var(--text-secondary);font-size:.9rem;margin:0;line-height:1.7;">
                    Chaque produit est rigoureusement sélectionné et vérifié par nos experts avant d'être proposé à nos clients.
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded h-100" style="background:var(--bg-card);border:1px solid var(--border);">
                <span class="val-num">02</span>
                <h5 class="fw-bold mb-2" style="color:var(--text-primary);">Service client réactif</h5>
                <p style="color:var(--text-secondary);font-size:.9rem;margin:0;line-height:1.7;">
                    Notre équipe répond à toutes vos questions en moins de 24 heures, par message ou par appel.
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded h-100" style="background:var(--bg-card);border:1px solid var(--border);">
                <span class="val-num">03</span>
                <h5 class="fw-bold mb-2" style="color:var(--text-primary);">Livraison rapide</h5>
                <p style="color:var(--text-secondary);font-size:.9rem;margin:0;line-height:1.7;">
                    Commandez aujourd'hui et recevez votre produit rapidement à votre adresse à Kinshasa.
                </p>
            </div>
        </div>
    </div>

    {{-- CTA final --}}
    <div class="text-center py-5 px-3 px-sm-5 rounded" style="background:linear-gradient(135deg,#088178,#0bbfb4);color:#fff;">
        <h4 class="fw-bold mb-2">Prêt à passer votre commande ?</h4>
        <p class="mb-4" style="opacity:.88;max-width:480px;margin:0 auto 24px;">
            Trouvez votre produit idéal et contactez-nous pour finaliser votre commande.
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="{{ route('products.index') }}" class="btn btn-light fw-semibold px-4">Voir les produits</a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light fw-semibold px-4">Nous contacter</a>
        </div>
    </div>

</div>
@endsection
