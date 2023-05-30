FROM php:8.1-fpm-alpine

# Instalar dependencias necesarias
RUN apk update && apk add --no-cache \
    curl \
    git \
    unzip

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql sockets

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copiar el archivo composer.json y composer.lock primero
COPY composer.json composer.lock ./

# Instalar dependencias
RUN composer install --no-interaction --no-scripts --no-autoloader

# Copiar el resto de los archivos
COPY . .

# Ejecutar el comando para generar el autoloader optimizado
RUN composer dump-autoload --optimize

CMD ["php", "artisan", "serve", "--host=0.0.0.0:8000"]
