FROM php:7.4.3-fpm-alpine3.11

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="1" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="20000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="256" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10" \
    HOST_IP="10.254.254.254" \
    PHP_IDE_CONFIG="serverName=_" \
    XDEBUG_CONFIG="idekey=PHPSTORM"

# [DO NOT DO IN PROD] Do not install xdebug in prod
RUN apk update \
    && apk add --no-cache icu-dev g++ make autoconf bash git \
    && docker-php-source extract \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-source delete \
    && docker-php-ext-install opcache bcmath intl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /tmp/*

# php.ini configuration
COPY php.ini /usr/local/etc/php

# [DO NOT DO IN PROD] PHP Xdebug configuration
COPY zzzz-docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/

# [DO NOT DO IN PROD] Xdebug is enabled by default. This will disable it by default. See README.md on how to enable it.
RUN sed -i 's/^zend_extension=/;zend_extension=/' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY zzzz-docker-php-ext-opcache.ini /usr/local/etc/php/conf.d/


# [DO NOT DO IN PROD] https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1

CMD ["php-fpm", "-F"]

WORKDIR /var/www/app

# [DO NOT DO IN PROD] 9001 = xdebug port to allow host to make debugging connections (see zzzz-docker-php-ext-xdebug.ini)
EXPOSE 9001
