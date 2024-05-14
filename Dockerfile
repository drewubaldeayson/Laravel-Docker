FROM php:7.2-fpm
LABEL maintenance="sixpathofdevops"

# COPY ./scripts /scripts

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
    libmagickwand-dev

RUN printf "\n" | pecl install imagick

# redis 
RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions for php
RUN docker-php-ext-install pdo pdo_mysql sockets mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd
RUN docker-php-ext-enable imagick

# RUN chmod -R +x /scripts

# Install composer (php package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# run some script outside
# ENV PATH="/scripts:$PATH"

# CMD ["run.sh"]