FROM php:7.1.3-fpm-alpine
RUN docker-php-ext-install pdo_mysql
RUN apk add --no-cache --virtual unzip zip
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

COPY . .
RUN composer install --no-progress --no-dev --optimize-autoloader --ignore-platform-reqs
