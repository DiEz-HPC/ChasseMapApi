#
# Prep App's PHP Dependencies
#
FROM composer:2.1 as vendor

WORKDIR /app

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist \
    --quiet
RUN composer require --dev orm-fixtures

FROM php:8.1-fpm-alpine as phpserver

# add cli tools
RUN apk update \
    && apk upgrade \
    && apk add nginx

RUN apk add --no-cache \
      libzip-dev \
      zip \
    && docker-php-ext-install zip

# silently install 'docker-php-ext-install' extensions
RUN set -x

RUN docker-php-ext-install pdo_mysql bcmath > /dev/null

# Install INTL
RUN apk add icu-dev 
RUN docker-php-ext-configure intl && docker-php-ext-install intl

COPY ./docker/nginx.conf /etc/nginx/nginx.conf

COPY ./docker/php.ini /usr/local/etc/php/conf.d/local.ini
RUN cat /usr/local/etc/php/conf.d/local.ini

WORKDIR /var/www

COPY . /var/www/
COPY --from=vendor /app/vendor /var/www/vendor

EXPOSE 80

COPY ./docker/docker-entry.sh /etc/entrypoint.sh
ENTRYPOINT ["sh", "/etc/entrypoint.sh"]