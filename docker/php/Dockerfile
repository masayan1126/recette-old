FROM php:fpm-alpine

RUN apk update && \
    apk add --update --no-cache && \
    docker-php-ext-install pdo_mysql

RUN apk add git

#Composer install
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin

WORKDIR /var/www

RUN composer global require "laravel/installer"


# node のインストール npm のため
RUN apk add --update nodejs nodejs-npm


WORKDIR /var/www