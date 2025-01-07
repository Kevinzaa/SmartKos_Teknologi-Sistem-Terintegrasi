FROM php:8.1-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html

# Set permissions for writable and uploads directories
RUN mkdir -p /var/www/html/writable /var/www/html/uploads && \
    chown -R www-data:www-data /var/www/html/writable /var/www/html/uploads

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set environment variables
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Configure Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
