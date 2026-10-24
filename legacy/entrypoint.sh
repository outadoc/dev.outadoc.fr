#!/usr/bin/env sh
set -e

# The uploads volume may be empty on first start: create the upload
# directories used by the admin, and make sure PHP-FPM can write to them
UPLOADS=/var/www/html/public/assets/img/data
mkdir -p "$UPLOADS/thumb" "$UPLOADS/screen"
chown www-data:www-data "$UPLOADS" "$UPLOADS/thumb" "$UPLOADS/screen"

php-fpm -D
nginx -g 'daemon off;'
