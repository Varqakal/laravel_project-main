@extends('layouts.admin')

@section('title', 'Modifier : ' . $category->name)
@section('page-title', 'Modifier la catégorie')

@section('content')
<div class="card border-0 shadow-sm" style="max-width:600px;">
    <div class="card-body p-4">
        @if($category->image)
        <div class="mb-3">
            <label class="form-label">Image actuelle</label><br>
            <img src="{{ Storage::url($category->image) }}" height="100" style="border-radius:8px;">
        </div>
        @endif
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.categories._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
