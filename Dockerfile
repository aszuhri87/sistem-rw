FROM php:8.1-fpm-bullseye

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl \
    lua-zlib-dev \
    libmemcached-dev \
    nginx \
    libpq-dev \
    libonig-dev\ 
    libzip-dev \
    supervisor \
    libfreetype6-dev \
    libmcrypt-dev \
    libpng12-dev \
    libjpeg-dev \
    libpng-dev

# Install php extensions
RUN docker-php-ext-install mbstring pdo_mysql mysqli pdo_pgsql pgsql zip exif pcntl gd

COPY --from=composer:2.3.10 /usr/bin/composer /usr/bin/composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Set working directory
WORKDIR /var/www/

# Copy code to /var/www
COPY --chown=www:www-data . /var/www/

RUN composer install --optimize-autoloader --no-dev

# add root to www group
RUN chmod -R ug+w /var/www/storage

# Copy nginx/php/supervisor configs
RUN cp supervisor.conf /etc/supervisord.conf
RUN cp php/local.ini /usr/local/etc/php/conf.d/app.ini
RUN cp nginx/nginx.conf /etc/nginx/sites-enabled/default

# PHP Error Log Files
RUN mkdir /var/log/php
RUN touch /var/log/php/errors.log && chmod 777 /var/log/php/errors.log

# Deployment steps
RUN chmod +x /var/www/run.sh

EXPOSE 8000
ENTRYPOINT ["/var/www/run.sh"]