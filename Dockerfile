FROM php:7.2-stretch
RUN apt-get update -y && apt-get install -y openssl zip unzip git php7.2-sqlite
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring
WORKDIR /app/src/Infrastructure/Framework/Laravel

CMD php artisan key:generate &&\
php artisan migrate &&\
composer dumpautoload &&\
php artisan serve --host=0.0.0.0 --port=8181

EXPOSE 8181
