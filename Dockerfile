FROM php:7.2-cli
COPY . /usr/src/app
RUN pecl install redis && docker-php-ext-enable redis
WORKDIR /usr/src/app
