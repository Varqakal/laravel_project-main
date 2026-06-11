<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label fw-bold">Nom du produit *</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $product->name ?? '') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">Catégorie *</label>
        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
            <option value="">— Choisir —</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Prix ($) *</label>
        <input type="number" name="price" step="0.01" min="0"
               class="form-control @error('price') is-invalid @enderror"
               value="{{ old('price', $product->price ?? '') }}" required>
        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Ancien prix ($)</label>
        <input type="number" name="old_price" step="0.01" min="0"
               class="form-control"
               value="{{ old('old_price', $product->old_price ?? '') }}"
               placeholder="Optionnel">
    </div>
    <div class="col-md-4">
        <label class="form-label">Badge</label>
        <select name="badge" class="form-select">
            <option value="">Aucun</option>
            <option value="new" {{ old('badge', $product->badge ?? '') === 'new' ? 'selected' : '' }}>NEW</option>
            <option value="hot" {{ old('badge', $product->badge ?? '') === 'hot' ? 'selected' : '' }}>HOT</option>
            <option value="sale" {{ old('badge', $product->badge ?? '') === 'sale' ? 'selected' : '' }}>SALE</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="col-md-3">
        <label class="form-label">Ordre d'affichage</label>
        <input type="number" name="sort_order" min="0" class="form-control"
               value="{{ old('sort_order', $product->sort_order ?? 0) }}">
    </div>
    <div class="col-md-3 d-flex align-items-end gap-3 pb-2">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featured"
                {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="featured">En vedette</label>
        </div>
    </div>
    <div class="col-md-3 d-flex align-items-end pb-2">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="active"
                {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="active">Actif</label>
        </div>
    </div>

    <div class="col-12" x-data="imagePreview()">
        <label class="form-label fw-bold">Images du produit</label>
        <input type="file" name="images[]" multiple accept="image/*"
               class="form-control" @change="preview($event)">
        <small class="text-muted">JPG, PNG, WEBP — max 3 Mo par image. La 1ère image sera l'image principale.</small>
        <div class="d-flex flex-wrap gap-2 mt-2 img-preview-wrap">
            <template x-for="src in previews" :key="src">
                <img :src="src" alt="aperçu">
            </template>
        </div>
    </div>
</div>

<script>
function imagePreview() {
    return {
        previews: [],
        preview(e) {
            this.previews = [];
            Array.from(e.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = ev => this.previews.push(ev.target.result);
                reader.readAsDataURL(file);
            });
        }
    };
}
</script>
