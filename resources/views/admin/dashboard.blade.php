@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stat-card stat-products">
            <div class="stat-value">{{ $stats['products'] }}</div>
            <div class="stat-label">Produits</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-categories">
            <div class="stat-value">{{ $stats['categories'] }}</div>
            <div class="stat-label">Catégories</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-messages">
            <div class="stat-value">{{ $stats['messages'] }}</div>
            <div class="stat-label">Messages total</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card stat-unread">
            <div class="stat-value">{{ $stats['unread'] }}</div>
            <div class="stat-label">Non lus</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold border-bottom">
                Derniers messages
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary float-end">
                    Voir tout
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <tbody>
                            @forelse($recentMessages as $msg)
                            <tr class="{{ !$msg->is_read ? 'table-warning' : '' }}">
                                <td>
                                    <div class="fw-bold">{{ $msg->name }}</div>
                                    <small class="text-muted">{{ $msg->email }}</small>
                                </td>
                                <td class="small text-muted">{{ Str::limit($msg->subject ?? $msg->message, 40) }}</td>
                                <td class="text-end small text-muted">
                                    {{ $msg->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.messages.show', $msg) }}"
                                       class="btn btn-sm btn-outline-secondary">Voir</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">Aucun message</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold border-bottom">
                Derniers produits
                <a href="{{ route('admin.produits.create') }}" class="btn btn-sm btn-primary float-end">
                    + Ajouter
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <tbody>
                            @forelse($recentProducts as $product)
                            <tr>
                                <td>
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" width="40" height="40"
                                             style="object-fit:cover; border-radius:4px;">
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $product->name }}</div>
                                    <small class="text-muted">{{ $product->category->name }}</small>
                                </td>
                                <td class="fw-bold text-primary">${{ number_format($product->price, 2) }}</td>
                                <td>
                                    <a href="{{ route('admin.produits.edit', $product) }}"
                                       class="btn btn-sm btn-outline-secondary">Modifier</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">Aucun produit</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
