<div class="row g-3">
    <div class="col-12">
        <label class="form-label fw-bold">Nom *</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $category->name ?? '') }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="3" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <small class="text-muted">JPG, PNG, WEBP — max 2 Mo</small>
    </div>
    <div class="col-6">
        <label class="form-label">Ordre d'affichage</label>
        <input type="number" name="sort_order" min="0" class="form-control"
               value="{{ old('sort_order', $category->sort_order ?? 0) }}">
    </div>
    <div class="col-6 d-flex align-items-end pb-1">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Catégorie active</label>
        </div>
    </div>
</div>
