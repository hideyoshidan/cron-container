FROM php:8.0.7-fpm

# hostとdockerの日付合わせ
RUN /bin/cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

# phpの必要なmodule、linuxのコマンド群をinstall
RUN apt-get update && \
    apt-get install -y \
    sudo \
    gzip \
    rsyslog \
    ca-certificates \
    curl \
    xz-utils \
    vim \
    cron \
    procps \
    zip \
    gnupg \
    unzip &&\
    docker-php-ext-install pdo_mysql

# php.iniを置いてあげちゃう。
COPY ./php.ini /etc/opt/remi/php80/

# Composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

RUN mv composer.phar /usr/local/bin/composer

# NodeJs install
COPY --from=node /usr/local/bin/node /usr/local/bin/
COPY --from=node /usr/local/lib/node_modules/ /usr/local/lib/node_modules/

# npmとnpxコマンドを使用できるようにする
RUN ln -s /usr/local/bin/node /usr/local/bin/nodejs \
    && ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npx