FROM php:8.4-cli

# System packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libsqlite3-dev \
    libonig-dev \
    libxml2-dev \
    zip

# PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite

# Composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Work directory
WORKDIR /app

# Copy project
COPY . .

# 🔥 CREATE SQLITE DATABASE (МАҢЫЗДЫ)
RUN mkdir -p database && touch database/database.sqlite

# 🔥 PERMISSIONS (тағы маңызды)
RUN chmod -R 777 storage database

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate app key (если нет)
RUN php artisan key:generate || true

# Laravel cache clear
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan route:clear

# 🔥 MIGRATE (база құрылсын)
RUN php artisan migrate --force || true

# Port
EXPOSE 10000

# Run server
CMD php artisan serve --host=0.0.0.0 --port=10000
