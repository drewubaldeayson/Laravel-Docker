FROM php:7.4-fpm
LABEL maintenance="sixpathofdevops"

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    jpegoptim optipng pngquant gifsicle \
    locales \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libmagickwand-dev \
    libpq-dev # Install PostgreSQL development library

# Install imagick extension
RUN printf "\n" | pecl install imagick

# Install redis extension
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Install PDO_PGSQL extension for PostgreSQL
RUN docker-php-ext-install pdo_pgsql

# Install gd extension with dependencies
RUN docker-php-ext-install gd

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions for php
RUN docker-php-ext-install pdo pdo_mysql sockets mbstring zip exif pcntl
RUN docker-php-ext-enable imagick

# Install composer (php package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
