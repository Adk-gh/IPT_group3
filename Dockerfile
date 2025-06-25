# Use official PHP image
FROM php:8.2-apache

WORKDIR /var/www/html

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql zip mbstring gd

RUN a2enmod rewrite
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies without scripts
RUN COMPOSER_ALLOW_SUPERUSER=1 COMPOSER_NO_DEV=1 COMPOSER_SKIP_AUTOSCRIPTS=1 composer install --optimize-autoloader --no-interaction || true

# Now copy everything
COPY . .

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Apache public folder config
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

EXPOSE 8080

CMD bash -c "composer dump-autoload --optimize && php artisan config:clear && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan storage:link || true && apache2-foreground"
