FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libsqlite3-dev libonig-dev libxml2-dev zip

RUN docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN mkdir -p /app/database && touch /app/database/database.sqlite
RUN chmod -R 777 storage database

RUN composer install --no-dev --optimize-autoloader

# 🔥 ОСЫ ЕКЕУ МАҢЫЗДЫ
RUN php artisan config:clear
RUN php artisan cache:clear

RUN php artisan key:generate || true

EXPOSE 10000

CMD php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=10000
