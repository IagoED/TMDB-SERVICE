FROM php:7.4-cli

WORKDIR /var/www

COPY . .

RUN apt-get update && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN docker-php-ext-install curl

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "src/"]