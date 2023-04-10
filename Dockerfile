FROM nginx:latest

RUN apt-get update && \
    apt-get install -y \
        php7.4-fpm \
        php7.4-sqlite3 \
        sqlite3

COPY ./nginx.conf /etc/nginx/nginx.conf
COPY ./php-fpm.conf /etc/php/7.4/fpm/php-fpm.conf

WORKDIR /var/www/html
