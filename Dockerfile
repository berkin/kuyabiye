FROM php:5-apache

RUN docker-php-ext-install mysql pdo pdo_mysql
RUN a2enmod rewrite
