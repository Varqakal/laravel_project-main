@extends('layouts.admin')

@section('title', 'Modifier la bannière')
@section('page-title', 'Modifier la bannière')

@section('content')
<div class="card border-0 shadow-sm" style="max-width:600px;">
    <div class="card-body p-4">
        @if($banner->image)
        <div class="mb-3">
            <label class="form-label">Image actuelle</label><br>
            <img src="{{ Storage::url($banner->image) }}" style="height:120px; border-radius:8px;">
        </div>
        @endif
        <form action="{{ route('admin.bannieres.update', $banner) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.banners._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('admin.bannieres.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
