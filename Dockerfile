# syntax=docker/dockerfile:1.7

ARG PHP_VERSION=8.3
ARG NODE_VERSION=20

########################################
# 1) Frontend build (Vite + Tailwind/DaisyUI)
########################################
FROM node:${NODE_VERSION}-alpine AS frontend

WORKDIR /app

# Repo ships a bun.lockb, not package-lock.json, so use a plain install here.
COPY package.json ./
RUN npm install

COPY resources/ resources/
COPY public/ public/
COPY vite.config.js tailwind.config.js postcss.config.js ./

RUN npm run build

########################################
# 2) PHP dependencies (composer)
########################################
FROM php:${PHP_VERSION}-cli-alpine AS vendor

# Composer binary only — PHP itself matches the runtime stage/composer.lock platform constraint
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY database/ database/
COPY composer.json composer.lock ./

# Install without dev deps, without running scripts (no app code yet / no artisan bootstrapping)
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader

########################################
# 3) Runtime image: PHP-FPM + Nginx + Supervisor
########################################
FROM php:${PHP_VERSION}-fpm-alpine AS runtime

LABEL org.opencontainers.image.source="https://github.com/vitaltechmyanmar/gh-actions-yaml-generator"

# System packages: nginx, supervisor, and libs needed by PHP extensions
RUN apk add --no-cache \
        nginx \
        supervisor \
        bash \
        curl \
        sqlite \
        icu-libs \
        libzip \
        libpng \
        libjpeg-turbo \
        freetype \
        oniguruma \
    && apk add --no-cache --virtual .build-deps \
        icu-dev \
        libzip-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        oniguruma-dev \
        sqlite-dev \
        $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_sqlite \
        pdo_mysql \
        bcmath \
        intl \
        zip \
        gd \
        opcache \
        pcntl \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

# PHP / OPcache production configuration
COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-app.ini
COPY docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

# Nginx and Supervisor configuration
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Composer binary (needed for dump-autoload at build time and any future artisan/composer ops)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Application code
COPY . .

# Vendor (from composer stage) and built frontend assets (from node stage)
COPY --from=vendor /app/vendor ./vendor
COPY --from=frontend /app/public/build ./public/build

# Finish composer setup now that app code + vendor are present, then cache framework config
RUN composer dump-autoload --optimize --no-dev --no-interaction \
    && php artisan config:clear

# Non-root user for the app; www-data already exists in the php-fpm alpine image
RUN addgroup -g 1000 -S www \
    && adduser -u 1000 -S www -G www \
    && mkdir -p storage/framework/{cache,sessions,testing,views} storage/logs bootstrap/cache database \
    && touch database/database.sqlite \
    && chown -R www:www /var/www/html \
    && chown -R www:www /var/lib/nginx /var/log/nginx /run/nginx 2>/dev/null || true

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8080

HEALTHCHECK --interval=30s --timeout=5s --start-period=20s --retries=3 \
    CMD curl -fsS http://127.0.0.1:8080/up || exit 1

ENTRYPOINT ["entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
