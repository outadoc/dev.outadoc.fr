FROM php:7.1.3-fpm

EXPOSE 80

VOLUME [ "/var/www/html/public/assets/img/data" ]

RUN echo "memory_limit = 512M" > "$PHP_INI_DIR/conf.d/custom-php.ini"

# Install dependencies
RUN docker-php-ext-install pdo_mysql
RUN apt-get update -y \
    && apt-get install -y nginx unzip
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Setup NGINX
COPY entrypoint.sh /bin/entrypoint.sh
COPY nginx-site.conf /etc/nginx/sites-enabled/default

RUN mkdir -p /var/cache/dev.outadoc.fr && chown -R www-data:www-data /var/cache/dev.outadoc.fr
RUN mkdir -p /var/log/dev.outadoc.fr && chown -R www-data:www-data /var/log/dev.outadoc.fr

# Build app
WORKDIR /var/www/html
COPY --chown=www-data:www-data . .
RUN composer install --no-progress --no-dev --optimize-autoloader --ignore-platform-reqs

ENTRYPOINT ["sh", "/bin/entrypoint.sh"]
