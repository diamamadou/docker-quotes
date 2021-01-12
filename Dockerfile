FROM php:7.2-apache

COPY config/php.ini /usr/local/etc/php/

RUN docker-php-ext-install mysqli