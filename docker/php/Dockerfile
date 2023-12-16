FROM php:8.1-fpm-buster

ENV COMPOSER_ALLOW_SUPERUSER=1 \
  COMPOSER_HOME=/composer

COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
  apt-get -y install --no-install-recommends git unzip libzip-dev libicu-dev libonig-dev && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-install intl pdo_mysql zip bcmath

COPY ./php.ini /usr/local/etc/php/php.ini

# Node.js, npm, nvmのインストール
RUN apt-get update && \
    apt-get -y install curl && \
    curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh | bash && \
    export NVM_DIR="$HOME/.nvm" && \
    [ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh" && \
    nvm install node && \
    apt-get purge -y --auto-remove curl && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /data
