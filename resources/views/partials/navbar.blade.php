<nav class="navbar navbar-expand-lg main-nav">
    <div class="container d-flex align-items-center py-2 gap-3">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="site-logo flex-shrink-0">
            <span>Electro</span>Vitrine
        </a>

        {{-- Search bar (desktop xl+) --}}
        <div class="nav-search d-none d-xl-flex flex-grow-1">
            <form action="{{ route('search') }}" method="GET" class="w-100">
                <div class="input-group">
                    <select name="category" class="form-select">
                        <option value="">Toutes catégories</option>
                        @foreach($navCategories ?? [] as $cat)
                            <option value="{{ $cat->id }}"
                                {{ request()->query('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="q" class="form-control"
                           placeholder="Rechercher un produit..."
                           value="{{ request('q') }}">
                    <button class="btn-search" type="submit">Rechercher</button>
                </div>
            </form>
        </div>

        {{-- Right side --}}
        <div class="ms-auto d-flex align-items-center gap-2">

            {{-- Desktop nav links --}}
            <ul class="navbar-nav flex-row align-items-center gap-1 d-none d-lg-flex">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('home')) active @endif"
                       href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle
                       @if(request()->routeIs('categories.*','products.*')) active @endif"
                       href="#" data-bs-toggle="dropdown">Produits</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('products.index') }}">
                                Tous les produits
                            </a>
                        </li>
                        @if(count($navCategories ?? []) > 0)
                            <li><hr class="dropdown-divider"></li>
                            @foreach($navCategories ?? [] as $cat)
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('categories.show', $cat->slug) }}">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('about')) active @endif"
                       href="{{ route('about') }}">À propos</a>
                </li>
            </ul>

            <button type="button" class="theme-toggle" id="themeToggle" aria-label="Changer de thème" title="Changer de thème">
                <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
                <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="5"></circle>
                    <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"></path>
                </svg>
            </button>

            <x-whatsapp-button label="Commander"
                class="btn btn-whatsapp btn-sm d-none d-lg-inline-flex justify-content-center"
                style="padding: 8px 22px; border-radius: 9px; font-size: .85rem;" />

            {{-- Mobile toggler --}}
            <button class="navbar-toggler d-lg-none" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        {{-- Mobile collapse --}}
        <div class="collapse navbar-collapse d-lg-none w-100 mt-2" id="mobileMenu">
            <form action="{{ route('search') }}" method="GET" class="mb-3">
                <div class="input-group"
                     style="background:rgba(255,255,255,.05);border:1px solid var(--border);border-radius:10px;overflow:hidden;">
                    <select name="category" class="form-select" style="background:transparent;border:none;border-right:1px solid var(--border);color:var(--text-muted);font-size:.8rem;max-width:110px;box-shadow:none;">
                        <option value="">Toutes</option>
                        @foreach($navCategories ?? [] as $cat)
                            <option value="{{ $cat->id }}"
                                {{ request()->query('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="q" class="form-control"
                           placeholder="Rechercher..."
                           value="{{ request('q') }}"
                           style="background:transparent;border:none;color:var(--text-primary);box-shadow:none;">
                    <button class="btn-search" type="submit">OK</button>
                </div>
            </form>
            <ul class="navbar-nav gap-1">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Tous les produits</a></li>
                @foreach($navCategories ?? [] as $cat)
                    <li class="nav-item">
                        <a class="nav-link" style="padding-left:24px !important;"
                           href="{{ route('categories.show', $cat->slug) }}">{{ $cat->name }}</a>
                    </li>
                @endforeach
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">À propos</a></li>
                <li class="nav-item mt-2">
                    <x-whatsapp-button label="Commander" class="btn btn-whatsapp w-100 justify-content-center" />
                </li>
            </ul>
        </div>

    </div>
</nav>
