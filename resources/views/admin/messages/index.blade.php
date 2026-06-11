@extends('layouts.admin')

@section('title', 'Messages')
@section('page-title', 'Messages & Demandes')

@section('content')
@include('partials.flash')

<div class="d-flex gap-2 mb-4">
    <a href="{{ route('admin.messages.index') }}"
       class="btn btn-sm {{ !request('status') ? 'btn-dark' : 'btn-outline-secondary' }}">
        Tous ({{ $messages->total() }})
    </a>
    <a href="{{ route('admin.messages.index') }}?status=unread"
       class="btn btn-sm {{ request('status') === 'unread' ? 'btn-danger' : 'btn-outline-danger' }}">
        Non lus ({{ $unreadCount }})
    </a>
    <a href="{{ route('admin.messages.index') }}?status=read"
       class="btn btn-sm {{ request('status') === 'read' ? 'btn-success' : 'btn-outline-success' }}">
        Lus
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Produit</th>
                    <th>Sujet</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr class="{{ !$msg->is_read ? 'fw-bold' : '' }}">
                    <td>{{ $msg->name }}</td>
                    <td>
                        <a href="mailto:{{ $msg->email }}" title="Envoyer un email">
                            {{ $msg->email }}
                        </a>
                    </td>
                    <td>
                        @if($msg->phone)
                            <div class="d-flex align-items-center gap-1">
                                <a href="tel:{{ $msg->phone }}" class="text-dark" title="Appeler">
                                    {{ $msg->phone }}
                                </a>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}"
                                   target="_blank"
                                   title="Contacter sur WhatsApp"
                                   style="color:#25D366;font-size:1.1rem;line-height:1;">
                                    &#128235;
                                </a>
                            </div>
                        @else
                            <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td class="small">{{ $msg->product->name ?? '—' }}</td>
                    <td class="small">{{ Str::limit($msg->subject ?? $msg->message, 50) }}</td>
                    <td class="small text-muted">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        @if(!$msg->is_read)
                            <span class="badge bg-danger">Nouveau</span>
                        @else
                            <span class="badge bg-success">Lu</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.messages.show', $msg) }}"
                           class="btn btn-sm btn-outline-primary">Voir</a>
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST"
                              class="d-inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-4 text-muted">Aucun message.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $messages->links() }}</div>
@endsection
