#official PHP 8.3 image
FROM php:8.3-fpm

WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    libpq-dev \
    libzip-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    libfreetype-dev


RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd
COPY . /var/www/html

# Install composer and run composer install
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy and execute startup script
COPY startup.sh /usr/local/bin/startup.sh
RUN chmod +x /usr/local/bin/startup.sh
CMD ["/usr/local/bin/startup.sh"]
