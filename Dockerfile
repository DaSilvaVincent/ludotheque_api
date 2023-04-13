# Use an official PHP runtime as the base image
FROM php:8.1-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Install dependencies
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

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files to container
COPY . .

# Copy .env files to container
COPY .env.example .env

# Create database.sqlite files to container
RUN touch database/database.sqlite

# Install application dependencies with Composer
RUN composer install --optimize-autoloader

# Create key to container
RUN php artisan key:generate

# Create key to container
RUN php artisan jwt:secret

# Initialize database.sqlite
RUN php artisan migrate:fresh --seed

# Set the ownership and permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 777 /var/www/html/storage
RUN chmod 664 database/database.sqlite

# Expose port 8000 for web server
EXPOSE 8000

# Run Laravel application
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
