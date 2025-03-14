# Prueba Técnica PHP

**Aplicación en PHP (sin frameworks)** que implementa un **sistema de registro de usuarios** utilizando **Doctrine** para la persistencia en MySQL.  
Se ha aplicado **DDD (Domain-Driven Design)**, **Clean Architecture** y se incluyen **pruebas automatizadas**.

## Requisitos
Antes de ejecutar la aplicación, asegúrate de tener instalados:
- **Docker** y **Docker Compose** (para contenedores)
- **Make** (opcional, para facilitar la ejecución de comandos)

# Cómo Ejecutar la Aplicación

## 1 Clona el repositorio en tu máquina:
```bash
git clone https://github.com/ivinales/ApiPhp.git

cd ApiPhp
```
## 2️ Ejecuta los contenedores con Docker:
```bash
make build
```
 Si no tienes **make**, ejecuta manualmente:
```bash
docker-compose up -d --build
```
## 3 Revisar el estado del inicio del contenedor
```bash
make log
```
Si no tienes **make**. ejecuta manualmente:
```bash
docker-compose logs -f php
```
## Cómo Probar la API
1) Usando Postman
2) Usando curl en la terminal

## Opción 1: Usar Postman
Método: POST

URL: http://localhost:8080/register

JSON Body:
```bash
{
"name": "Juan",
"email": "juan@example.com",
"password": "SecurePass1!"
}
```
## Opción 2: Usar curl en la terminal
Si no tienes Postman, puedes hacer la petición con curl:
```bash
curl -X POST "http://localhost:8080/register" \
     -H "Content-Type: application/json" \
     -d '{
           "name": "Juan",
           "email": "juan222@example.com",
           "password": "SecurePass1!"
         }'
```

**Si el registro es exitoso**, recibirás una respuesta como:

```bash
Simulando envío de correo
bienvenid@: juan222@example.com
{
"id": "0b0b7af75c7d3d1d59776c2f980240ad",
"name": "Juan",
"email": "juan222@example.com",
"createdAt": "2025-03-11 21:03:18"
}
```

## Pruebas Automatizadas
La aplicación incluye pruebas unitarias y de integración con PHPUnit.
Para ejecutar las pruebas dentro del contenedor PHP:
```bash
make test
```
Si no tienes make, usa:
```bash
docker-compose exec php vendor/bin/phpunit
```
## Para detener y eliminar los contenedores
```bash
make down
```
 Si no tienes **make**, ejecuta manualmente:
```bash
docker-compose down
```