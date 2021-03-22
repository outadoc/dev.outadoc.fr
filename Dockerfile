FROM php:8.0-fpm

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

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | sudo apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | sudo tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update -y \
    && apt-get install -y nginx unzip yarn

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Build app
WORKDIR /var/www/html
COPY --chown=www-data:www-data . .

RUN yarn install
RUN node_modules/.bin/encore production
RUN composer install --no-progress --optimize-autoloader --ignore-platform-reqs

ENTRYPOINT ["sh", "/bin/entrypoint.sh"]
