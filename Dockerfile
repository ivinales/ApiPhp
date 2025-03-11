FROM php:8.1-fpm

# Instalar dependencias y extensiones necesarias
RUN apt-get update && apt-get install -y \
    unzip git libonig-dev libzip-dev zip net-tools netcat-traditional \
    && docker-php-ext-install pdo_mysql

# Instalar Composer (usando la imagen oficial de Composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copiar el código fuente al contenedor
COPY . .

# Copiar el entrypoint para ejecución automática
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Usar el entrypoint para ejecutar comandos automáticamente al iniciar
ENTRYPOINT ["/entrypoint.sh"]

CMD ["php-fpm"]
