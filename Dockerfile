FROM php:7.2-rc-cli

WORKDIR /app
ADD . /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

EXPOSE 8000

WORKDIR /app
CMD nohup php artisan serve --host="0.0.0.0"