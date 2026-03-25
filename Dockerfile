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

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate app key (если нет)
RUN php artisan key:generate || true

# Laravel cache clear (важно)
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan route:clear

# Port
EXPOSE 10000

# Run server
CMD php artisan serve --host=0.0.0.0 --port=10000
