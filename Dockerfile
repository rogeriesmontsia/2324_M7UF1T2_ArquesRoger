FROM php:8.0-apache

RUN pecl install xdebug && docker-php-ext-enable xdebug \
    && echo "\
xdebug.mode = debug \n\
xdebug.start_with_request = yes \n\
xdebug.client_host = 172.17.0.1 \n\
xdebug.client_port = 9000 \n\
" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20200930/xdebug.so" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
