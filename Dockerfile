FROM php:8.4-cli

# Dépendances système
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libpng-dev libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip gd \
    && rm -rf /var/lib/apt/lists/*

# Composer (copié depuis l'image officielle composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Node 20 pour npm run build
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /app
COPY . .

# Build PHP + front
RUN composer install --no-dev --optimize-autoloader \
    && npm ci \
    && npm run build

# Démarrage
CMD php artisan config:clear \
    && php artisan migrate --force \
    && php artisan db:seed --class=AdminUserSeeder --force \
    && php artisan storage:link --force \
    && php artisan serve --host=0.0.0.0 --port=$PORT