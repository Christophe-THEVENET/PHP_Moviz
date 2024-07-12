FROM php:8.2-apache

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    zlib1g-dev \
    g++ \
    libicu-dev \
    git \
    && pecl install apcu \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip opcache intl

# Activer les modules Apache nécessaires
RUN a2enmod rewrite

# Définir le répertoire de travail
WORKDIR /var/www

