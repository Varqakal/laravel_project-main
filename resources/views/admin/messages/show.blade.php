@extends('layouts.admin')

@section('title', 'Message de ' . $message->name)
@section('page-title', 'Détail du message')

@section('content')
@include('partials.flash')

<div class="card border-0 shadow-sm" style="max-width:700px;">
    <div class="card-body p-4">

        {{-- Informations client --}}
        <h6 class="text-muted fw-semibold mb-3 text-uppercase" style="font-size:.75rem;letter-spacing:.08em;">
            Informations du client
        </h6>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <small class="text-muted d-block">Nom</small>
                <div class="fw-bold">{{ $message->name }}</div>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block">Adresse email</small>
                <div>
                    <a href="mailto:{{ $message->email }}" class="text-primary">
                        {{ $message->email }}
                    </a>
                </div>
            </div>
            @if($message->phone)
            <div class="col-md-6">
                <small class="text-muted d-block">Téléphone / WhatsApp</small>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <a href="tel:{{ $message->phone }}" class="fw-semibold">
                        {{ $message->phone }}
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}"
                       target="_blank"
                       class="btn btn-sm fw-semibold"
                       style="background:#25D366;color:#fff;border:none;padding:3px 12px;border-radius:20px;font-size:.8rem;">
                        WhatsApp
                    </a>
                    <a href="tel:{{ $message->phone }}"
                       class="btn btn-sm btn-outline-secondary"
                       style="padding:3px 12px;border-radius:20px;font-size:.8rem;">
                        Appeler
                    </a>
                </div>
            </div>
            @endif
            @if($message->product?->id)
            <div class="col-md-6">
                <small class="text-muted d-block">Produit demandé</small>
                <div>
                    <a href="{{ route('products.show', $message->product->slug) }}" target="_blank" class="text-primary">
                        {{ $message->product->name }}
                    </a>
                </div>
            </div>
            @endif
            <div class="col-md-6">
                <small class="text-muted d-block">Sujet</small>
                <div class="fw-bold">{{ $message->subject ?? '(sans sujet)' }}</div>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block">Reçu le</small>
                <div>{{ $message->created_at->format('d/m/Y à H:i') }}</div>
            </div>
        </div>

        {{-- Corps du message --}}
        <h6 class="text-muted fw-semibold mb-2 text-uppercase" style="font-size:.75rem;letter-spacing:.08em;">
            Message
        </h6>
        <div class="p-3 rounded bg-light border mb-4">
            <pre style="white-space:pre-wrap; font-family:inherit; margin:0; color:#333;">{{ $message->message }}</pre>
        </div>

        {{-- Actions --}}
        <div class="d-flex flex-wrap gap-2">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject ?? 'Votre demande') }}"
               class="btn btn-primary">
                ✉️ Répondre par email
            </a>
            @if($message->phone)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}?text={{ urlencode('Bonjour ' . $message->name . ', nous avons bien reçu votre message concernant : ' . ($message->subject ?? 'votre demande') . '. Voici notre réponse :') }}"
               target="_blank"
               class="btn fw-semibold"
               style="background:#25D366;color:#fff;border:none;">
                💬 Répondre via WhatsApp
            </a>
            @endif
            <form action="{{ route('admin.messages.read', $message) }}" method="POST">
                @csrf @method('PATCH')
                <button class="btn btn-outline-secondary">
                    {{ $message->is_read ? 'Marquer non lu' : 'Marquer lu' }}
                </button>
            </form>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary ms-auto">
                ← Retour
            </a>
        </div>
    </div>
</div>
@endsection
