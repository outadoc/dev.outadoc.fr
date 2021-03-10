FROM php:7.1.3-fpm
RUN docker-php-ext-install pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY . .
RUN composer install --no-progress --no-dev --optimize-autoloader --ignore-platform-reqs
