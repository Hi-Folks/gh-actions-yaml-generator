#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

# Generate an APP_KEY on first boot if one isn't provided via env/secret
if [ -z "${APP_KEY:-}" ] && [ -f .env ]; then
    php artisan key:generate --force --no-interaction || true
fi

# Ensure sqlite file + writable dirs exist (covers mounted volumes too)
mkdir -p storage/framework/{cache,sessions,testing,views} storage/logs bootstrap/cache
touch database/database.sqlite 2>/dev/null || true
chown -R www:www storage bootstrap/cache database 2>/dev/null || true

# Run pending migrations (set RUN_MIGRATIONS=false to skip, e.g. run them as a separate Job/step instead)
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    php artisan migrate --force --no-interaction
fi

# Cache config/routes/views for production performance
if [ "${APP_ENV:-production}" = "production" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
else
    php artisan config:clear
fi

exec "$@"
