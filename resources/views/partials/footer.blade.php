<footer class="site-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <h6>Electro Vitrine</h6>
                <p class="small" style="color: var(--text-secondary);">
                    Votre destination pour les meilleurs appareils électroniques :
                    laptops, smartphones, caméras et accessoires de qualité.
                </p>
                <div class="mt-2 small" style="color: var(--text-muted);">
                    <div>+243 (0) 894166690</div>
                    <div></div>
                    <div>Kinshasa, République démocratique du Congo</div>
                </div>
                <div class="social-icons mt-3">
                    <a href="#" title="Facebook">f</a>
                    <a href="#" title="Instagram">in</a>
                    <a href="#" title="Twitter">tw</a>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 col-6">
                <h6>Catégories</h6>
                <ul>
                    @foreach($navCategories ?? [] as $cat)
                        <li>
                            <a href="{{ route('categories.show', $cat->slug) }}">{{ $cat->name }}</a>
                        </li>
                    @endforeach
                    <li><a href="{{ route('products.index') }}">Tous les produits</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 col-6">
                <h6>Informations</h6>
                <ul>
                    <li><a href="{{ route('about') }}">À propos de nous</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Conditions générales</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h6>Commander un produit</h6>
                <p class="small" style="color: var(--text-secondary);">
                    Vous souhaitez acquérir un de nos produits ? Contactez-nous directement.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-sm mt-2">
                    Nous contacter
                </a>
            </div>
        </div>

        <div class="footer-bottom text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Electro Vitrine. Tous droits réservés.</p>
        </div>
    </div>
</footer>
