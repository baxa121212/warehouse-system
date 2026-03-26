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

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Work directory
WORKDIR /app

# Copy project
COPY . .

# 🔥 SQLite база жасау
RUN mkdir -p /app/database && touch /app/database/database.sqlite

# 🔥 Permissions
RUN chmod -R 777 storage database

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Key (если нет)
RUN php artisan key:generate || true

# 🔥 ЕҢ МАҢЫЗДЫ — миграция
RUN php artisan migrate --force

# ❌ ОСЫЛАРДЫ АЛЫП ТАСТАДЫҚ (қате беретін)
# RUN php artisan config:clear
# RUN php artisan cache:clear
# RUN php artisan route:clear

# Port
EXPOSE 10000

# Run server
CMD php artisan serve --host=0.0.0.0 --port=10000
