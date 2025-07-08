FROM php:8.2-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Installer les extensions PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Activer mod_rewrite
RUN a2enmod rewrite

# Configuration Apache
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier uniquement composer.json pour installer proprement
COPY composer.json composer.lock ./

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer les dépendances Laravel
RUN composer install --no-scripts --no-autoloader --ignore-platform-reqs || true

# Copier tous les fichiers du projet
COPY . .

# Donner les droits nécessaires
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Optimiser autoload
RUN composer dump-autoload --optimize

EXPOSE 80
