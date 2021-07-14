FROM php:8.0.2-apache

# PHP で必要なライブラリをインストール
RUN apt-get update && apt-get install -y \
    && apt-get install -y libonig-dev libzip-dev unzip \
    && docker-php-ext-install mbstring zip bcmath \
    # xdebug インストール
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# mysqlのドライバーをインストール : PDOによるDB接続の際に使用
RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring
