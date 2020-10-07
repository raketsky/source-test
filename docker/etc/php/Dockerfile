FROM php:7.4-fpm

RUN apt-get update > /dev/null && apt-get install -y \
   git \
   libzip-dev \
   unzip \
   libxpm-dev \
   libmcrypt-dev \
   libicu-dev \
   g++ \
   nano \
   acl \
   default-mysql-client

RUN docker-php-ext-install bcmath

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www