FROM php:8.1-fpm-bullseye

# Install dependencies
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    unzip \
    supervisor

# Install php extensions
RUN docker-php-ext-install mbstring pdo_mysql zip exif pcntl gd

COPY --from=composer:2.3.10 /usr/bin/composer /usr/bin/composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Set working directory
WORKDIR /var/www/app

# Copy code to /var/www
COPY --chown=www:www-data . /var/www/cbt/


# Copy nginx/php/supervisor configs
RUN cp supervisor.conf /etc/supervisord.conf
RUN cp php/local.ini /usr/local/etc/php/conf.d/app.ini
RUN cp nginx/nginx.conf /etc/nginx/nginx.conf
RUN cp nginx/conf.d/app.conf /etc/nginx/sites-enabled/default

# PHP Error Log Files
RUN mkdir /var/log/php
RUN touch /var/log/php/errors.log && chmod 777 /var/log/php/errors.log

# Deployment steps
# RUN composer install --optimize-autoloader --no-dev
RUN chmod +x /var/www/app/run.sh

EXPOSE 8000
ENTRYPOINT ["/var/www/app/run.sh"]
