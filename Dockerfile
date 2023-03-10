FROM php:8.1-fpm-alpine

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

RUN apk add shadow && usermod -u 1000 www-data && groupmod -g 1000 www-data


