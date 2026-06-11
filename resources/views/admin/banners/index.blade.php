@extends('layouts.admin')

@section('title', 'Bannières')
@section('page-title', 'Gestion des Bannières')

@section('content')
@include('partials.flash')

<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('admin.bannieres.create') }}" class="btn btn-primary">+ Ajouter une bannière</a>
</div>

<div class="row g-3">
    @forelse($banners as $banner)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            @if($banner->image)
                <img src="{{ Storage::url($banner->image) }}" class="card-img-top"
                     style="height:160px; object-fit:cover;">
            @else
                <div class="bg-light" style="height:160px;"></div>
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="fw-bold mb-1">{{ $banner->title ?? '(Sans titre)' }}</h6>
                        <p class="text-muted small mb-1">{{ $banner->subtitle }}</p>
                    </div>
                    @if($banner->is_active)
                        <span class="badge bg-success">Actif</span>
                    @else
                        <span class="badge bg-secondary">Inactif</span>
                    @endif
                </div>
            </div>
            <div class="card-footer bg-white d-flex gap-2">
                <a href="{{ route('admin.bannieres.edit', $banner) }}"
                   class="btn btn-sm btn-outline-primary flex-grow-1">Modifier</a>
                <form action="{{ route('admin.bannieres.destroy', $banner) }}" method="POST"
                      onsubmit="return confirm('Supprimer ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5 text-muted">Aucune bannière.</div>
    @endforelse
</div>
@endsection
