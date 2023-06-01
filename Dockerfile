FROM php:8.1-fpm
# Instalar dependencias
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libzip-dev \
    libonig-dev \
    zip \
    curl \
    unzip \
    git \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libxml2-dev \
    libicu-dev
# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
# Instalar extensiones
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath opcache \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install dom xml curl
# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
COPY . /var/www
# Aquí es donde instalamos las dependencias de la aplicación
RUN composer install
RUN chown -R www-data:www-data \
    /var/www/storage \
    /var/www/bootstrap/cache
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
