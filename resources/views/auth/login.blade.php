<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin — Electro Vitrine</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: var(--dark); min-height:100vh; display:flex; align-items:center; justify-content:center;">
    <div class="card border-0 shadow-lg" style="width:100%; max-width:420px; border-radius:12px; overflow:hidden;">
        <div class="text-center py-4" style="background: linear-gradient(135deg, #088178, #0bbfb4);">
            <h2 class="text-white fw-800 mb-0">Electro Admin</h2>
            <p class="text-white-50 small mb-0">Espace administration</p>
        </div>
        <div class="card-body p-4">
            @if(session('status'))
                <div class="alert alert-success mb-3">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mb-3">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg"
                           value="{{ old('email') }}" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Mot de passe</label>
                    <input type="password" name="password" class="form-control form-control-lg" required>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    Se connecter
                </button>
            </form>
            <div class="text-center mt-3">
                <a href="{{ route('home') }}" class="text-muted small">Retour au site</a>
            </div>
        </div>
    </div>
</body>
</html>
