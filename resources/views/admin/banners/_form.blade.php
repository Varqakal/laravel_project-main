<div class="row g-3">
    <div class="col-12">
        <label class="form-label fw-bold">Titre</label>
        <input type="text" name="title" class="form-control"
               value="{{ old('title', $banner->title ?? '') }}">
    </div>
    <div class="col-12">
        <label class="form-label">Sous-titre</label>
        <input type="text" name="subtitle" class="form-control"
               value="{{ old('subtitle', $banner->subtitle ?? '') }}">
    </div>
    <div class="col-6">
        <label class="form-label">Texte du bouton</label>
        <input type="text" name="button_text" class="form-control"
               value="{{ old('button_text', $banner->button_text ?? 'Voir la collection') }}">
    </div>
    <div class="col-6">
        <label class="form-label">Lien du bouton</label>
        <input type="text" name="button_url" class="form-control"
               value="{{ old('button_url', $banner->button_url ?? '') }}"
               placeholder="/produits ou /categories/laptops">
    </div>
    <div class="col-12">
        <label class="form-label">Image (paysage recommandé)</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <small class="text-muted">JPG, PNG, WEBP — max 4 Mo. Dimensions recommandées : 1200×500px</small>
    </div>
    <div class="col-6">
        <label class="form-label">Ordre d'affichage</label>
        <input type="number" name="sort_order" min="0" class="form-control"
               value="{{ old('sort_order', $banner->sort_order ?? 0) }}">
    </div>
    <div class="col-6 d-flex align-items-end pb-1">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                {{ old('is_active', $banner->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Bannière active</label>
        </div>
    </div>
</div>
