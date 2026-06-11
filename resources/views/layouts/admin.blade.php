<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Electro Vitrine</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    <div class="admin-sidebar d-flex flex-column">
        <div class="brand"><span>Electro</span> Admin</div>
        <nav class="flex-grow-1 pt-2">
            <div class="nav-section">Principal</div>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif">
                Tableau de bord
            </a>

            <div class="nav-section mt-2">Catalogue</div>
            <a href="{{ route('admin.produits.index') }}"
               class="nav-link @if(request()->routeIs('admin.produits.*')) active @endif">
                Produits
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="nav-link @if(request()->routeIs('admin.categories.*')) active @endif">
                Catégories
            </a>
            <a href="{{ route('admin.bannieres.index') }}"
               class="nav-link @if(request()->routeIs('admin.bannieres.*')) active @endif">
                Bannières
            </a>

            <div class="nav-section mt-2">Communications</div>
            <a href="{{ route('admin.messages.index') }}"
               class="nav-link @if(request()->routeIs('admin.messages.*')) active @endif">
                Messages
                @php($unread = \App\Models\ContactMessage::unread()->count())
                @if($unread > 0)
                    <span class="badge bg-danger ms-auto">{{ $unread }}</span>
                @endif
            </a>

            <div class="nav-section mt-2">Site</div>
            <a href="{{ route('home') }}" target="_blank" class="nav-link">
                Voir le site
            </a>
        </nav>
        <div class="p-3 border-top" style="border-color: rgba(255,255,255,.1)!important;">
            <small class="text-muted d-block mb-1" style="color: rgba(255,255,255,.4)!important;">
                {{ auth()->user()->name }}
            </small>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger w-100">Déconnexion</button>
            </form>
        </div>
    </div>

    <div class="admin-main">
        <div class="admin-topbar">
            <h5 class="mb-0 fw-bold">@yield('page-title', 'Tableau de bord')</h5>
            <span class="text-muted small">{{ now()->format('d/m/Y') }}</span>
        </div>

        <div class="admin-content">
            @include('partials.flash')
            @yield('content')
        </div>
    </div>
</body>
</html>
