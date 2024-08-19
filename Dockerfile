FROM php:8.2-cli

RUN apt-get update && apt-get install -y unzip

RUN apt-get update && apt-get install -y git

RUN apt-get update && apt-get install -y libbrotli-dev

RUN apt-get update && apt-get install -y librdkafka-dev

RUN pecl install rdkafka \ && docker-php-ext-enable rdkafka

RUN pecl install swoole \ && docker-php-ext-enable swoole

RUN docker-php-ext-install bcmath

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

WORKDIR /var/www

COPY . /var/wwww

CMD ["php", "-S", "0.0.0.0:8081"]