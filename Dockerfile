# Use an official PHP runtime as the base image
FROM php:8.1-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files to container
COPY . .

# Install application dependencies with Composer
RUN composer install --optimize-autoloader --no-dev

# Set the ownership and permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage

# Expose port 80 for web server
EXPOSE 80

# Run Laravel application
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
