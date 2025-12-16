FROM php:8.4-fpm as base

RUN apt-get update && \
    apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        git \
        unzip \
        curl \
        libxml2-dev \
        libpq-dev --no-install-recommends && \
    rm -rf /var/lib/apt/lists/*


RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd zip pdo pdo_pgsql

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 9000
