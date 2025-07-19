# Use official PHP with Apache
FROM php:8.1-apache

# Enable mod_rewrite
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy all files to Apache's public directory
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Set working directory
WORKDIR /var/www/html

EXPOSE 80
