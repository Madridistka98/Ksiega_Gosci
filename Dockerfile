FROM php:7.4.9-apache-buster

ENV INSTALL_DIR /var/www/html
ENV COMPOSER_HOME /usr/local/bin

RUN rm -rf "/etc/apache2/sites-available/000-default.conf" && \
    rm -rf "/etc/apache2/sites-available/000-enabled.conf" && \
    rm -rf "/etc/apache2/sites-available/default-ssl.conf" && \
    echo 127.0.0.1 www.guest-book.dev.com guest-book.dev.com >> "/etc/hosts" && \ 
    a2enmod rewrite

RUN rm /bin/sh && ln -s /bin/bash /bin/sh && \
    apt-get -y update && \
    apt-get install -y  \
    libbz2-dev \
    libicu-dev \
    libsodium-dev \
    libmcrypt-dev \
    libpng++-dev \
    libzip-dev \
    libmcrypt4 \
    libjpeg-dev \
    libcurl3-dev \
    libfreetype6 \
    libfreetype6-dev \
    libicu-dev \
    libxslt1-dev \
    libssl-dev \
    lsof \
    default-mysql-client \
    gnupg2 \
    git && \ 
    docker-php-ext-configure gd --with-freetype --with-jpeg && \ 
    docker-php-ext-install \
    pdo_mysql \
    intl \
    xsl \
    phar  \
    opcache \
    pcntl \
    gettext \
    bz2 \
    gd && \
    rm -rf /var/lib/apt/lists/*
 
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" >> /usr/local/etc/php/conf.d/xdebug.ini && \ 
    curl -sL https://deb.nodesource.com/setup_current.x | bash - && \
    apt-get update -y && \
    apt-get install -y nodejs && \
    rm -rf /var/lib/apt/lists/* 

RUN curl -sS https://getcomposer.org/installer | \
    php --  --install-dir=$COMPOSER_HOME --filename=composer

COPY ./php.ini /usr/local/etc/php/
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY "guest-book.dev.com.conf" "/etc/apache2/sites-available/guest-book.dev.com.conf"
COPY "guest-book.dev.com.conf" "/etc/apache2/sites-enabled/guest-book.dev.com.conf"
COPY "apache2.conf" "/etc/apache2/apache2.conf"



# RUN  printf '* */1 * * * php /var/www/html/update/cron.php\n' >> /etc/crontab \
#   && printf '* */1 * * * php /var/www/html/bin/magento cron:run\n' >> /etc/crontab \
#   && printf '* */1 * * * php /var/www/html/bin/magento setup:cron:run\n#\n' >> /etc/crontab \
# RUN service cron start

WORKDIR $INSTALL_DIR


