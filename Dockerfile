#LABEL maintainer="j.koehler@outlook.com"
#ENTRYPOINT ["/usr/local/bin/ocrmypdf"]


#FROM composer:1.9 as build
#WORKDIR /app/
#COPY composer.json composer.lock /app/
#RUN composer install --ignore-platform-reqs

FROM php:7.3-apache-stretch
RUN apt-get update && apt-get install -y \
    libpq-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev libicu-dev nano git apt-utils zip\
 && rm -rf /var/lib/apt/lists/*

RUN  docker-php-ext-configure gd \
            --with-gd \
            --with-freetype-dir=/usr/include/ \
            --with-png-dir=/usr/include/ \
            --with-jpeg-dir=/usr/include/
RUN docker-php-ext-configure pcntl --enable-pcntl
RUN docker-php-ext-install pdo_mysql intl pcntl gd
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

ENV APP_ENV=prod
ENV HTTPDUSER='www-data'

EXPOSE 8080

#COPY --from=build /app/vendor /var/www/html/vendor
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/  && \
    a2enmod rewrite && \
    echo "Listen 8080" > /etc/apache2/ports.conf && \
    sed -i '/</,/>/ s/*:80/*:8080/' /etc/apache2/sites-enabled/000-default.conf

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride all/' /etc/apache2/apache2.conf && \
    sed -i '/<VirtualHost/,/<\/VirtualHost>/ s/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\/public/' /etc/apache2/sites-enabled/000-default.conf

USER www-data

RUN composer install
RUN php bin/console cache:clear --no-warmup && \
    php bin/console cache:warmup

RUN rm /var/www/html/.env.*
#RUN touch /var/www/html/.env

CMD ["apache2-foreground"]
#ENTRYPOINT ["tail", "-f", "/dev/null"]