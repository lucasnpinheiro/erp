FROM php:8.2-fpm-alpine3.18

LABEL Maintainer="Lucas Pinheiro" \
      Description="latest PHP8.2 fpm Docker image. Use `docker-php-ext-install extension_name` to install Extensions." \
      License="MIT License" \
      Version="1.0.0"

# Environments
ENV TZ UTC

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_HOME=/usr/local/share/composer

# Install usermod and usermod www-data
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk add --no-cache shadow
RUN usermod -u 1000 www-data

# Set timezone
RUN set -ex && \
    apk update && \
    apk upgrade && \
    apk add --no-cache tzdata && \
    cp /usr/share/zoneinfo/$TZ /etc/localtime && \
    echo $TZ > /etc/timezone && \
    apk del tzdata && \
    rm -rf /tmp/* /var/cache/apk/*

# Install extensions
# ref to: https://github.com/mlocati/docker-php-extension-installer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install PCOV
RUN apk add --no-cache autoconf build-base
RUN pecl install pcov && docker-php-ext-enable pcov
RUN chmod +x /usr/local/bin/install-php-extensions
RUN sync
RUN install-php-extensions \
        bz2 \
        csv \
        decimal \
        exif \
        gd \
        gettext \
        gmp \
        gnupg \
        grpc \
        igbinary \
        imagick \
        imap \
        intl \
        memcache \
        memcached \
        mysqli \
        opcache \
        pdo_mysql \
        redis \
        soap \
        sockets \
        ssh2 \
        timezonedb \
        uuid \
        xdebug \
        xlswriter \
        xsl \
        yaml \
        zip
    
RUN install-php-extensions @composer
RUN rm -rf /tmp/* /var/cache/apk/*
RUN set -ex && \
    PHP_INI_DIR=$(php --ini | grep "Scan for additional .ini files in" | cut -d':' -f2 | cut -d' ' -f2 | head -n1) && \
    : && \
    ## timezone
    echo "date.timezone = ${TZ}" > $PHP_INI_DIR/zz-timezone.ini && \
    : && \
    echo 'expose_php = off' > $PHP_INI_DIR/zz-hide-header-version.ini

COPY opcache.ini PHP_INI_DIR/zz-opcache.ini
COPY php.ini PHP_INI_DIR/zz-php.ini

USER www-data