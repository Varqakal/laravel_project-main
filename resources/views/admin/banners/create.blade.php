@extends('layouts.admin')

@section('title', 'Ajouter une bannière')
@section('page-title', 'Ajouter une bannière')

@section('content')
<div class="card border-0 shadow-sm" style="max-width:600px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.bannieres.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.banners._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Créer</button>
                <a href="{{ route('admin.bannieres.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
