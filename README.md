# Foobar

Desarrollo de sistema para el test técnico de Cargofive.
El sistema se encuentra desarrollado en Laravel, Vue y base de datos pgsql.
Se desarrollo siguiendo las directivas de "Develoment Hiring Test - PHP", utilizando el Excel suministrado como prueba. En el directorio raíz adjunto dichos archivos en la carpeta llamada "Archivos Suministrados".

## Requisitos para poder operar localmente el proyecto


node => 12.*
 
Descargar:
https://nodejs.org/es/blog/release/v12.13.0/

php  => 7.2

Descargar: https://www.php.net/downloads.php

postgreSql => PostgreSQL 10

Descargar: https://www.postgresql.org/download/

Para continuar de aqui en adelante, recordar que debemos tener el proyecto clonado.

## Para la instalación
Para la instalación de Laravel debemos situándonos en el directorio raiz del proyecto y escribir lo siguiente...

## Installation Laravel

```bash
composer install
```
Para la instalación de Vue debemos situándonos en el directorio raiz del proyecto y escribir lo siguiente...
## Installation Vue 

```bash
npm
-> npm install 

yarn
-> yarn install
```

## Usage
Para comenzar a utilizarlo, debemos configurar nuestro .env.

Dentro del directorio raíz tenemos un archivo llamado ".env.example" el cual debemos renombrar a .env

Una vez hecho el cambio debemos configurar la conexión a la db como en el siguiente ejemplo

```php
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1 //si es local dejamos como esta, si no ingresamos el IP correspondiente
DB_PORT=5432 //el puerto 5432 es por defecto, si tenemos otro, debemos cambiarlo aquí
DB_DATABASE=cargofivetest //nombre de nuestra base de datos
DB_USERNAME=postgres //usuario de postgres
DB_PASSWORD=postgres //contraseña de postgres
```
## Migraciones
Una vez tengamos el .env configurado debemos crear en nuestro motor de base de datos nuestra base de datos con el nombre que cargamos anteriormente en el .env

Una vez realizado esto podemos correr las migraciones de Laravel, debemos situarnos en el directorio raíz y escribir lo siguiente
```bash
php artisan migrate --seed
```
Esto creara las migraciones y el usuario por defecto.

## Para poner a funcional el sistema en  local
En la raíz del del 
```bash
php artisan migrate --seed
```


## Ingreso al sistema
En la raíz del proyecto en una consola debemos escribir lo siguiente para poner en funcionamiento Laravel
```bash
php artisan serve
```
En la raiz del proyecto en una consola debemos escribir lo siguiente para poner en funcionamiento Vue
```bash
php artisan serve
```
Una vez esto este compilado podemos ingresar a la siguiente URL y utilizar el sistema

Ruta local:http://127.0.0.1:8000/

Usuario: admin@admin.com

Contraseña: admin2021