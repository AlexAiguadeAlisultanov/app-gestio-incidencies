FROM php:8.2-apache

# Lo que pide Laravel 10, mas las herramientas para instalar dependencias.
RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif bcmath \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Las dependencias primero, en su propia capa: mientras no cambien, las
# reconstrucciones se las saltan.
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction

COPY . .
RUN composer dump-autoload --optimize --no-dev \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Laravel sirve desde public/, no desde la raiz del proyecto.
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" \
        /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

ENV PORT=8080
EXPOSE 8080

# Las migraciones se lanzan al arrancar, para que la base quede lista sola.
# Apache trae el 80 fijo y el puerto real no se conoce hasta este momento.
CMD php artisan migrate --force || true; \
    php artisan config:cache || true; php artisan route:cache || true; php artisan view:cache || true; \
    sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf && \
    sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf && \
    apache2-foreground
