# Usa la imagen oficial de PHP 8.1 con FPM para ejecutar código PHP
FROM php:8.1-fpm

# Instalar dependencias y extensiones necesarias
RUN apt-get update && apt-get install -y \
    unzip git libonig-dev libzip-dev zip net-tools netcat-traditional \
    && docker-php-ext-install pdo_mysql

# Instalar Composer (usando la imagen oficial de Composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece el directorio de trabajo en `/var/www` dentro del contenedor
WORKDIR /var/www

# Copiar el código fuente al contenedor
COPY . .

# Dar permisos adecuados
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www

# Define el comando por defecto para ejecutar el servidor PHP-FPM
CMD ["php-fpm"]
