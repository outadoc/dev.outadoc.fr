# Build front-end assets
FROM node:24 AS assets

WORKDIR /app
COPY package.json package-lock.json webpack.config.js ./
RUN npm ci --no-fund

COPY assets ./assets
RUN npx encore production

FROM php:8.5-fpm

EXPOSE 80

VOLUME [ "/var/www/html/public/assets/img/data" ]

# Can be overridden at runtime, but the image only ships production dependencies
ENV APP_ENV=prod

# Use PHP's production defaults: never print errors in responses, log them instead
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN echo "memory_limit = 1024M" > "$PHP_INI_DIR/conf.d/custom-php.ini"

# Setup NGINX
COPY entrypoint.sh /bin/entrypoint.sh
COPY nginx-site.conf /etc/nginx/sites-enabled/default

# Install dependencies
RUN docker-php-ext-install pdo_mysql

RUN apt-get update -y \
    && apt-get install -y nginx unzip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Build app
WORKDIR /var/www/html
COPY --chown=www-data:www-data . .
COPY --from=assets --chown=www-data:www-data /app/public/build ./public/build

# Installing also warms up the prod cache, which must then be writable by PHP-FPM
RUN composer install --no-dev --no-progress --optimize-autoloader \
    && mkdir -p /var/cache/dev.outadoc.fr /var/log/dev.outadoc.fr \
    && chown -R www-data:www-data /var/cache/dev.outadoc.fr /var/log/dev.outadoc.fr

ENTRYPOINT ["sh", "/bin/entrypoint.sh"]
