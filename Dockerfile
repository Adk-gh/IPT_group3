# Use official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev zip libzip-dev libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql zip mbstring gd

# Enable mod_rewrite
RUN a2enmod rewrite

# Suppress Apache ServerName warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy the entire project (including artisan) BEFORE composer install
COPY . .

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache && chmod -R 775 storage bootstrap/cache

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set Apache document root to Laravel public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

EXPOSE 80

# Start Apache and run artisan setup
CMD bash -c "php artisan config:clear && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan storage:link || true && apache2-foreground"
