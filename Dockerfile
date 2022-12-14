FROM php:7.4.30

RUN curl -sS https://getcomposer.org/installer | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y zlib1g-dev \
    libzip-dev \
    unzip 

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

RUN install-php-extensions zip

RUN install-php-extensions gd

RUN mkdir /app

ADD . /app

WORKDIR /app

RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000
