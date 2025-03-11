# Construye y levanta los contenedores
build:
	docker-compose up -d --build

# Detiene y elimina contenedores + volúmenes
down:
	docker-compose down

# Ejecuta pruebas con PHPUnit
test:
	docker-compose exec php vendor/bin/phpunit

# Muestra logs del contenedor PHP
log:
	docker-compose logs -f php
