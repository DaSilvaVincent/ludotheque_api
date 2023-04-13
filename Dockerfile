# Utiliser une image PHP officielle en tant qu'image de base
FROM php:8.1-fpm

# Définir le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Installer les dépendances
RUN apt-get update && apt-get install -y \
    curl \
    git \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libsqlite3-dev \
    sqlite3

# Installer les extensions PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier les fichiers de l'application dans le conteneur
COPY . .

# Copier les fichiers .env dans le conteneur
COPY .env.example .env

# Créer le fichier database.sqlite dans le conteneur
RUN touch database/database.sqlite

# Installer les dépendances de l'application avec Composer
RUN composer install --optimize-autoloader

# Générer la clé de l'application
RUN php artisan key:generate

# Générer la clé JWT
RUN php artisan jwt:secret

# Initialiser la base de données sqlite
RUN php artisan migrate:fresh --seed

# Définir les propriétaires et les permissions pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage
RUN chmod 664 database/database.sqlite

# Exposer le port 8000 pour le serveur web
EXPOSE 8000

# Exécuter l'application Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
