FROM php:7.4-fpm

ARG C_UID=1001
ARG C_GID=1001

RUN apt-get update && apt-get install -y \
  host \
  iproute2 \
  cron \
  git \
  gzip \
  libfreetype6-dev \
  libicu-dev \
  libjpeg62-turbo-dev \
  libmcrypt-dev \
  libpng-dev \
  libxslt1-dev \
  libonig-dev \
  lsof \
  default-mysql-client \
  libmagickwand-dev --no-install-recommends \
  vim \
  jq \
  pv \
  libzip-dev \
  zip \
  procps \
  rsync \
  sudo \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure \
  gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/

RUN pecl channel-update pecl.php.net \ 
  && pecl install imagick \ 
  && docker-php-ext-enable imagick 

RUN docker-php-ext-install \
  bcmath \
  gd \
  intl \
  mbstring \
  opcache \
  pdo_mysql \
  soap \
  xsl \
  zip \
  sockets

RUN pecl channel-update pecl.php.net \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && sed -i -e 's/^zend_extension/\;zend_extension/g' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Clean up apt-get update
RUN rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | \
  php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g ${C_GID} app \
  && useradd -g ${C_GID} -u ${C_UID} -d /var/www -s /bin/bash app

COPY conf/www.conf /usr/local/etc/php-fpm.d/
COPY conf/php.ini /usr/local/etc/php/
COPY conf/xdebug.ini /usr/local/etc/php/conf.d/
COPY conf/php-fpm.conf /usr/local/etc/

RUN mkdir /sock
RUN chown -R app:app /usr/local/etc/php/conf.d /sock

RUN mkdir -p /var/www && mkdir -p /var/www/conf/nginx/ && chown -R app:app /var/www/

RUN mkdir -p /var/www && chown -R app:app /var/www/
RUN echo "app ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers.d/app

USER app:app
VOLUME /var/www

WORKDIR /var/www/html

EXPOSE 9001 

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT [ "docker-entrypoint.sh" ]
CMD [ "php-fpm" ]
