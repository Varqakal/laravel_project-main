@extends('layouts.admin')

@section('title', 'Ajouter un produit')
@section('page-title', 'Ajouter un produit')

@section('content')
<div class="card border-0 shadow-sm" style="max-width:800px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.produits.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.products._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">Créer le produit</button>
                <a href="{{ route('admin.produits.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
