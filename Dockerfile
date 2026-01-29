FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    git unzip libpq-dev \
 && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

EXPOSE 8000

CMD sh -lc "composer install --no-interaction && php artisan key:generate --force || true && php artisan serve --host=0.0.0.0 --port=8000"
