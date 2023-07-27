FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /app

COPY composer.lock composer.json /app/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-scripts --no-autoloader

COPY . /app

RUN composer dump-autoload

CMD ["php-fpm"]

EXPOSE 9000
