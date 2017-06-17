FROM php:7.1-cli

RUN yes | pecl install xdebug
RUN docker-php-ext-enable xdebug


