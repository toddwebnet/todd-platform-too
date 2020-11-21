ARG PHP_DOCKERFILE_SOURCE=I_WILL_FAIL
FROM ${PHP_DOCKERFILE_SOURCE}


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

RUN apt-get install cron -y

RUN apt-get install sshpass -y

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

RUN apt-get update
RUN apt-get install default-mysql-client -y
RUN apt-get install default-libmysqlclient-dev -y




RUN apt-get install default-mysql-client -y
RUN apt-get install default-libmysqlclient-dev -y

RUN  apt-get clean



RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer

RUN mkdir -p /root/.ssh && touch /root/.ssh/known_hosts
RUN ssh-keyscan -t rsa pfsense.lan >> ~root/.ssh/known_hosts

# Source the bash
COPY ./crontab/docker /etc/cron.d/docker
RUN chmod 0644 /etc/cron.d/docker
RUN crontab /etc/cron.d/docker
RUN touch /var/log/cron.log
RUN echo 'starting the cron'
CMD cron && tail -f /var/log/cron.log
WORKDIR /var/www
