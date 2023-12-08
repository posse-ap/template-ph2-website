FROM php:fpm-buster
# タイムゾーン(東京)
ENV TZ Asia/Tokyo
# 色々パッケージとか追加(パッケージの操作管理などに使うツール類？とmysqliパッケージ)
RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
vim \
libpq-dev \
&& docker-php-ext-install pdo_mysql pdo_pgsql mysqli

# Composer2.0 install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY src /usr/share/nginx/html