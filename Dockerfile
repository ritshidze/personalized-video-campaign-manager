# Dockerfile

FROM php:8.3-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    netcat-openbsd \
    procps \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www/html

# Ensure www-data owns the necessary directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Set correct permissions for storage and cache directories
RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Install application dependencies
# RUN composer install --no-dev --optimize-autoloader

# Copy the PHP configuration file
COPY php/local.ini /usr/local/etc/php/conf.d/local.ini

# Copy the entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod -R 775 /usr/local/bin/entrypoint.sh

# Expose port 9000 and start php-fpm server
EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# CMD ["php-fpm"]