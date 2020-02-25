FROM php:7.3-fpm
# add the backend
RUN apt-get update

RUN apt-get update -y && apt-get install -y openssl zip unzip git awscli
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

RUN  apt-get install -y libmcrypt-dev \
        libmagickwand-dev --no-install-recommends \
        && pecl install mcrypt-1.0.2 \
        && docker-php-ext-install pdo_mysql \
        && docker-php-ext-enable mcrypt

COPY ./ /hawkeye-inventory

WORKDIR /hawkeye-inventory

RUN composer install

RUN php artisan config:clear

CMD php artisan migrate:refresh --seed --force && php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000
