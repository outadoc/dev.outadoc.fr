# Build front-end assets
# The Encore/webpack toolchain in yarn.lock doesn't support Node 17+, so it's
# only used at build time and never shipped in the final image.
FROM node:16-bullseye AS assets

WORKDIR /app
COPY package.json yarn.lock webpack.config.js ./
RUN yarn install --frozen-lockfile

COPY assets ./assets
RUN node_modules/.bin/encore production

FROM php:8.4-fpm

EXPOSE 80

VOLUME [ "/var/www/html/public/assets/img/data" ]

RUN echo "memory_limit = 1024M" > "$PHP_INI_DIR/conf.d/custom-php.ini"

# Setup NGINX
COPY entrypoint.sh /bin/entrypoint.sh
COPY nginx-site.conf /etc/nginx/sites-enabled/default

RUN mkdir -p /var/cache/dev.outadoc.fr && chown -R www-data:www-data /var/cache/dev.outadoc.fr
RUN mkdir -p /var/log/dev.outadoc.fr && chown -R www-data:www-data /var/log/dev.outadoc.fr

# Install dependencies
RUN docker-php-ext-install pdo_mysql

RUN apt-get update -y \
    && apt-get install -y nginx unzip

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Build app
WORKDIR /var/www/html
COPY --chown=www-data:www-data . .
COPY --from=assets --chown=www-data:www-data /app/public/build ./public/build

RUN composer install --no-progress --optimize-autoloader --ignore-platform-reqs

ENTRYPOINT ["sh", "/bin/entrypoint.sh"]
