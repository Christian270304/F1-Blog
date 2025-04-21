FROM php:8.2-fpm

# Instala extensiones y herramientas necesarias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libonig5 \
    && docker-php-ext-install pdo pdo_mysql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crea directorio de la app
WORKDIR /var/www

# Copia todos los archivos al contenedor
COPY . .

# Instala dependencias de Laravel
RUN composer install --optimize-autoloader --no-dev

# Asigna permisos
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Expone el puerto 8000
EXPOSE 8000

# Comando para ejecutar Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}

