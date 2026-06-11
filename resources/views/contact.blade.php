@extends('layouts.app')

@section('title', 'Commander — Contact')

@section('content')

{{-- ── Hero ─────────────────────────────────────────────────── --}}
<div style="background:linear-gradient(135deg,var(--bg-base) 0%,#111d35 100%);padding:56px 0;border-bottom:1px solid var(--border);">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 mb-4">
            <span class="contact-pill green">&#10003; Réponse sous 24h</span>
            <span class="contact-pill teal">&#10003; Sans engagement</span>
            <span class="contact-pill purple">&#10003; Livraison Kinshasa</span>
        </div>
        <h1 class="fw-bold mb-2" style="font-size:clamp(1.7rem,3.5vw,2.6rem);letter-spacing:-.5px;color:var(--text-primary);">
            Commandez en quelques minutes
        </h1>
        <p style="color:rgba(255,255,255,.68);max-width:540px;font-size:1rem;line-height:1.7;margin:0;">
            Remplissez le formulaire ci-dessous ou contactez-nous directement sur WhatsApp.
            Notre équipe vous répond personnellement sous 24 heures.
        </p>
    </div>
</div>

<div class="container py-5">
    @include('partials.flash')

    <div class="row g-5">

        {{-- ── Formulaire ──────────────────────────────────── --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-sm-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div style="width:42px;height:42px;border-radius:11px;background:rgba(var(--primary-rgb),.12);border:1px solid rgba(var(--primary-rgb),.22);display:flex;align-items:center;justify-content:center;">
                            <span style="color:var(--primary);font-weight:900;font-size:.85rem;">&#9997;</span>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0" style="color:var(--text-primary);">Formulaire de commande</h5>
                            <p style="color:var(--text-muted);font-size:.8rem;margin:0;">Tous les champs marqués * sont obligatoires</p>
                        </div>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-600">Nom complet *</label>
                                <input type="text" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       placeholder="Votre nom complet"
                                       required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-600">Adresse email *</label>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="votre@email.com"
                                       required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    Numéro WhatsApp / Téléphone
                                    <span style="color:var(--primary);font-weight:600;font-size:.78rem;margin-left:4px;">Recommandé</span>
                                </label>
                                <input type="tel" name="phone"
                                       class="form-control"
                                       value="{{ old('phone') }}"
                                       placeholder="+243 8xx xxx xxx">
                                <div style="color:var(--text-muted);font-size:.75rem;margin-top:4px;">
                                    Nous vous répondrons sur WhatsApp si fourni
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Produit souhaité</label>
                                <select name="product_id" class="form-select">
                                    <option value="">— Sélectionner un produit —</option>
                                    @foreach($categories as $cat)
                                        @if($cat->products->isNotEmpty())
                                            <optgroup label="{{ $cat->name }}">
                                                @foreach($cat->products as $prod)
                                                    <option value="{{ $prod->id }}"
                                                        {{ (old('product_id', $selectedProduct?->id) == $prod->id) ? 'selected' : '' }}>
                                                        {{ $prod->name }} — ${{ number_format($prod->price, 2) }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Sujet</label>
                                <input type="text" name="subject"
                                       class="form-control"
                                       value="{{ old('subject') }}"
                                       placeholder="Ex: Demande de prix, Disponibilité, Livraison...">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-600">Votre message *</label>
                                <textarea name="message" rows="4"
                                          class="form-control @error('message') is-invalid @enderror"
                                          placeholder="Décrivez votre demande en détail : quantité souhaitée, questions sur le produit, délai de livraison..."
                                          required>{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold" style="letter-spacing:.5px;">
                                    Envoyer ma demande de commande
                                </button>
                                <p style="text-align:center;color:var(--text-muted);font-size:.78rem;margin-top:10px;margin-bottom:0;">
                                    Gratuit · Sans engagement · Réponse personnalisée sous 24h
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ── Sidebar droite ────────────────────────────── --}}
        <div class="col-lg-5 d-flex flex-column gap-4">

            {{-- WhatsApp CTA --}}
            @if($whatsappLink)
            <div class="card border-0" style="background:linear-gradient(135deg,#075e54,#128c7e);border:none !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div style="width:44px;height:44px;border-radius:12px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="#fff">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="fw-bold" style="color:#fff;font-size:1rem;">Commander via WhatsApp</div>
                            <div style="color:rgba(255,255,255,.75);font-size:.8rem;">Réponse en quelques minutes</div>
                        </div>
                    </div>
                    <p style="color:rgba(255,255,255,.82);font-size:.88rem;margin-bottom:16px;line-height:1.6;">
                        Préférez un contact direct ? Envoyez-nous un message WhatsApp et nous vous répondrons immédiatement.
                    </p>
                    <a href="{{ $whatsappLink }}" target="_blank"
                       class="btn w-100 fw-bold"
                       style="background:#25D366;color:#fff;border:none;padding:12px;">
                        Ouvrir WhatsApp maintenant
                    </a>
                </div>
            </div>
            @endif

            {{-- Pourquoi nous choisir --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color:var(--text-primary);">Pourquoi commander chez nous ?</h6>
                    <ul class="benefit-list">
                        <li>
                            <span class="benefit-check">&#10003;</span>
                            <span><strong style="color:var(--text-primary);">Produits certifiés</strong> — Chaque appareil est testé et vérifié avant livraison</span>
                        </li>
                        <li>
                            <span class="benefit-check">&#10003;</span>
                            <span><strong style="color:var(--text-primary);">Prix compétitifs</strong> — Les meilleurs tarifs du marché à Kinshasa</span>
                        </li>
                        <li>
                            <span class="benefit-check">&#10003;</span>
                            <span><strong style="color:var(--text-primary);">Livraison rapide</strong> — Recevez votre commande directement chez vous</span>
                        </li>
                        <li>
                            <span class="benefit-check">&#10003;</span>
                            <span><strong style="color:var(--text-primary);">SAV disponible</strong> — Assistance après-vente en cas de problème</span>
                        </li>
                        <li>
                            <span class="benefit-check">&#10003;</span>
                            <span><strong style="color:var(--text-primary);">1000+ clients satisfaits</strong> — Rejoignez notre communauté de clients fidèles</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Coordonnées --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color:var(--text-primary);">Nos coordonnées</h6>
                    <div style="display:flex;flex-direction:column;gap:12px;">
                        <div style="display:flex;align-items:flex-start;gap:10px;">
                            <div style="width:28px;height:28px;border-radius:7px;background:rgba(var(--primary-rgb),.1);border:1px solid rgba(var(--primary-rgb),.18);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--primary);font-size:.75rem;font-weight:900;">T</div>
                            <div>
                                <div style="color:var(--text-muted);font-size:.75rem;">Téléphone</div>
                                <div style="color:var(--text-primary);font-weight:600;font-size:.9rem;">+243 (0) 844392754</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:flex-start;gap:10px;">
                            <div style="width:28px;height:28px;border-radius:7px;background:rgba(var(--primary-rgb),.1);border:1px solid rgba(var(--primary-rgb),.18);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--primary);font-size:.75rem;font-weight:900;">@</div>
                            <div>
                                <div style="color:var(--text-muted);font-size:.75rem;">Email</div>
                                <div style="color:var(--text-primary);font-weight:600;font-size:.9rem;">gedeontshiangala60@gmail.com</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:flex-start;gap:10px;">
                            <div style="width:28px;height:28px;border-radius:7px;background:rgba(var(--primary-rgb),.1);border:1px solid rgba(var(--primary-rgb),.18);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--primary);font-size:.75rem;font-weight:900;">H</div>
                            <div>
                                <div style="color:var(--text-muted);font-size:.75rem;">Horaires</div>
                                <div style="color:var(--text-primary);font-weight:600;font-size:.9rem;">Lun – Sam : 9h00 – 18h00</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:flex-start;gap:10px;">
                            <div style="width:28px;height:28px;border-radius:7px;background:rgba(var(--primary-rgb),.1);border:1px solid rgba(var(--primary-rgb),.18);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--primary);font-size:.75rem;font-weight:900;">L</div>
                            <div>
                                <div style="color:var(--text-muted);font-size:.75rem;">Localisation</div>
                                <div style="color:var(--text-primary);font-weight:600;font-size:.9rem;">Kinshasa, RD Congo</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
(function () {
    const form = document.getElementById('contactForm');
    if (!form) return;
    form.addEventListener('submit', function () {
        const btn = form.querySelector('[type=submit]');
        btn.disabled = true;
        btn.textContent = 'Envoi en cours...';
    });
})();
</script>
@endsection
