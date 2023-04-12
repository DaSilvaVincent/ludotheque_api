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
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files to container
COPY . .

# Install application dependencies with Composer
RUN composer install --optimize-autoloader --no-dev

# Set the ownership and permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 777 /var/www/html/storage

# Expose port 80 for web server
EXPOSE 80

# Run Laravel application
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
