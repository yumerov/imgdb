FROM php:7.2-rc-cli

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 8000

WORKDIR /app
CMD ./docker-start.sh