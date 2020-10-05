# based off of php 7.1.5 example: https://blog.cloud66.com/deploying-your-cakephp-applications-with-cloud-66/
#start with our base image (the foundation) - version 7.3.3
# latest from https://hub.docker.com/_/php/
FROM php:7.3.3-apache
#install all the system dependencies
RUN apt-get update && apt-get install -y \
  libicu-dev \
  libpq-dev \
  mysql-client \
  zip \
  unzip \
  # https://github.com/Safran/RoPA/issues/4
  libzip-dev \
  # https://stackoverflow.com/questions/2977662/php-zip-installation-on-linux
  zlib1g-dev \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  && rm -r /var/lib/apt/lists/*
# configure the php modules
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
  && docker-php-ext-install \
  intl \
  mbstring \
  pcntl \
  pdo_mysql \
  zip \
  opcache \
  gd

#install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

#set our application folder as an environment variable
ENV APP_HOME /var/www/html
# 
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
# https://stackoverflow.com/questions/25922882/php-docker-script-unable-to-write-to-tmp
# RUN chmod 777 -R /tmp && chmod o+t -R /tmp
#change the web_root to cakephp /var/www/html/webroot folder
RUN sed -i -e "s/html/html\/webroot/g" /etc/apache2/sites-enabled/000-default.conf
# enable apache module rewrite
RUN a2enmod rewrite
#copy source files and run composer
COPY . $APP_HOME
# install all PHP dependencies
RUN composer install --no-interaction
#change ownership of our applications
RUN chown -R www-data:www-data $APP_HOME
