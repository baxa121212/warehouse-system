FROM php:8.4-cli

# System packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libsqlite3-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    nodejs \
    npm

# PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Work directory
WORKDIR /app

# Copy project
COPY . .

# Permissions
RUN chmod -R 777 storage

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader

# 🔥 FRONTEND BUILD
RUN npm install
RUN npm run build

# Key
RUN php artisan key:generate || true

# Port
EXPOSE 10000

# 🔥 RUNTIME
CMD mkdir -p /app/database && \
    touch /app/database/database.sqlite && \
    chmod -R 777 /app/database && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=10000
