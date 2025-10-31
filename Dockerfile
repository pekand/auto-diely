FROM php:8.4-fpm

# system deps
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# php extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl bcmath intl
RUN docker-php-ext-configure gd --with-jpeg --with-freetype && docker-php-ext-install gd

# install composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# workdir
WORKDIR /var/www

# copy existing application (optional)
# COPY . /var/www

# permissions helper
RUN useradd -G www-data -u 1000 -m appuser

# expose socket
EXPOSE 9000

CMD ["php-fpm"]