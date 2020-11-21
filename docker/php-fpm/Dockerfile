ARG PHP_FPM_DOCKERFILE_SOURCE=I_WILL_FAIL
FROM ${PHP_FPM_DOCKERFILE_SOURCE}

MAINTAINER James Todd <toddwebnet@gmail.com>

ENV DEBIAN_FRONTEND noninteractive
# Install "PHP Extentions", "libraries", "Software's"
RUN apt-get update && \
    apt-get install -y \
        git \
        curl \
        nano \
        zip \
        libcurl3-openssl-dev \
        libonig-dev \
        libzip-dev \
        libpng-dev \
        libicu-dev \
        libxml2-dev \
        libpq-dev \
        libz-dev libmemcached-dev

#RUN docker-php-ext-install memcached
RUN pecl install memcached


RUN docker-php-ext-install curl
RUN docker-php-ext-install intl
RUN docker-php-ext-install json
RUN docker-php-ext-install xml
# RUN docker-php-ext-install mbstring
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pgsql
# RUN docker-php-ext-install sqlite
# RUN docker-php-ext-install sqlite3
RUN docker-php-ext-install zip
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo_mysql

RUN pecl install redis && docker-php-ext-enable redis

RUN  apt-get clean



CMD ["php-fpm"]

ARG PHP_UPSTREAM_PORT=9000

EXPOSE ${PHP_UPSTREAM_PORT}
