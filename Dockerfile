#Docker file que incluye la imagen de php con apache
#En la configuracion se necesita instalar mysqli, PDO
#El PDO es el que se usara para el proyecto
FROM php:8.0.0-apache

ARG DEBIAN_FRONTEND=noninteractive

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update \
    && apt-get install -y libzip-dev \
    && apt-get install -y zlib1g-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip  

RUN pecl install redis && docker-php-ext-enable redis

RUN a2enmod rewrite

RUN service apache2 restart
#Instalar composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer