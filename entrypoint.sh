#!/bin/sh

echo "Iniciando configuración inicial..."

# Esperar a que MySQL esté listo antes de continuar
echo "Esperando a que MySQL esté listo..."
until nc -z -v -w30 mysql 3306; do
  echo "MySQL aún no está listo..."
  sleep 5
done
echo "MySQL está listo!"

# Instalar dependencias de Composer
if [ ! -d "vendor" ]; then
  echo "📦 Instalando dependencias de Composer..."
  composer install --no-interaction --optimize-autoloader
  composer require symfony/cache
  composer require --dev phpunit/phpunit
else
  echo "Dependencias de Composer ya instaladas, saltando instalación."
fi

# Ejecutar Doctrine para actualizar la base de datos
echo "Actualizando esquema de base de datos con Doctrine..."
vendor/bin/doctrine orm:schema-tool:update --force

echo "Configuración completa. Iniciando PHP-FPM..."
exec php-fpm
