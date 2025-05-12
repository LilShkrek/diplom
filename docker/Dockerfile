FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    sockets

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite
#COPY --chown=www-data:www-data ../src/public/.htaccess /var/www/html/public/.htaccess
#COPY --chown=www-data:www-data ../src/public/.htaccess /var/www/html/public/
RUN chmod -R 775 /var/www/html
RUN chown -R www-data:www-data /var/www/html

#COPY --chown=www-data:www-data ../src /var/www/html
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/*.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/*.conf && \
    a2ensite 000-default.conf

#FROM php:8.2-apache
#
## Установка зависимостей
#RUN apt-get update && apt-get install -y \
#    libpq-dev \
#    libzip-dev \
#    zip \
#    && docker-php-ext-install pdo pdo_pgsql zip
#
## Настройка Apache
#RUN a2enmod rewrite
#RUN mkdir -p /var/www/html
#WORKDIR /var/www/html
#
## Права для storage (будет перезаписано volume)
#RUN chown -R www-data:www-data /var/www/html