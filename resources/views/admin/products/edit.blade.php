@extends('layouts.admin')

@section('title', 'Modifier : ' . $product->name)
@section('page-title', 'Modifier le produit')

@section('content')
<div class="card border-0 shadow-sm" style="max-width:800px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.produits.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            @include('admin.products._form')

            {{-- Images existantes --}}
            @if($product->images->isNotEmpty())
            <div class="mb-3">
                <label class="form-label fw-bold">Images actuelles</label>
                <div class="d-flex flex-wrap gap-2 img-preview-wrap">
                    @foreach($product->images as $img)
                    <div class="existing-image" id="img-{{ $img->id }}">
                        <img src="{{ $img->url }}" alt="">
                        @if($img->is_primary)
                            <span class="badge bg-primary" style="position:absolute;bottom:2px;left:2px;font-size:.6rem;">Principal</span>
                        @endif
                        <button type="button" class="del-btn"
                                onclick="deleteImage({{ $img->id }}, {{ $product->id }})">&times;</button>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
                <a href="{{ route('admin.produits.index') }}" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<script>
function deleteImage(imageId, productId) {
    if (!confirm('Supprimer cette image ?')) return;
    fetch(`/admin/produits/${productId}/images/${imageId}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content }
    }).then(r => r.json()).then(d => {
        if (d.success) document.getElementById('img-' + imageId).remove();
    });
}
</script>
@endsection
