# Inicio

## Desarrollo de sistema para el test técnico de Cargofive.

El sistema se encuentra desarrollado en Laravel, Vue y base de datos pgsql.
Se desarrolló siguiendo las directivas de "Develoment Hiring Test - PHP", utilizando Excel suministrado como prueba. En el directorio raíz adjunto, dichos archivos se encuentran en la carpeta llamada "Archivos Suministrados".

## Librería para manipular Excel 

https://laravel-excel.com/

Esta librería nos permite trabajar con archivos Excel tanto para importar como para exportar. Al importar, podemos hacerlo tanto por columnas como por nombres de las mismas.
 
Para este ejercicio en particular, se utilizó la importación por números de columnas, ya que el archivo suministrado en las cabeceras tiene " ' " y puede causar inconvenientes al importarlos.

## Requisitos para poder operar localmente el proyecto


node => 12.*
 
Descargar:
https://nodejs.org/es/blog/release/v12.13.0/

php  => 7.2

Descargar: https://www.php.net/downloads.php

postgreSql => PostgreSQL 10

Descargar: https://www.postgresql.org/download/

Para continuar de aquí en adelante, recordar que debemos tener el proyecto clonado.

## Para la instalación
Para la instalación de Laravel debemos situarnos en el directorio raíz del proyecto y escribir lo siguiente:

## Instalación Laravel

```bash
composer install
```
Para la instalación de Vue debemos situarnos en el directorio raíz del proyecto y escribir lo siguiente:
## Instalación Vue 

```bash
npm
-> npm install 

yarn
-> yarn install
```

## Uso
Para comenzar a utilizarlo debemos configurar nuestro .env.

Dentro del directorio raíz, tenemos un archivo llamado ".env.example" el cual debemos renombrar a .env

Una vez hecho el cambio, debemos configurar la conexión a la db como en el siguiente ejemplo:

```php
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1 //si es local dejamos como está, si no, ingresamos el IP correspondiente
DB_PORT=5432 //el puerto 5432 es por defecto, si tenemos otro, debemos cambiarlo aquí
DB_DATABASE=cargofivetest //nombre de nuestra base de datos
DB_USERNAME=postgres //usuario de postgres
DB_PASSWORD=postgres //contraseña de postgres
```
## Migraciones
Una vez tengamos el .env configurado, crearemos en nuestro motor de base de datos nuestra base de datos, con el nombre que cargamos anteriormente en el .env.

Una vez realizado esto, podemos correr las migraciones de Laravel. Debemos situarnos en el directorio raíz, en la consola, y escribir lo siguiente:
```bash
php artisan migrate --seed
```
Esto creará las migraciones y el usuario por defecto.

## Ingreso al sistema
En la raíz del proyecto, en una consola, debemos escribir lo siguiente para poner en funcionamiento Laravel:
```bash
php artisan serve
```
En la raiz del proyecto, en una consola, debemos escribir lo siguiente para poner en funcionamiento Vue:
```bash
php artisan serve
```
Una vez que esto esté compilado, podemos ingresar a la siguiente URL y utilizar el sistema

Ruta local:http://127.0.0.1:8000/

Usuario: admin@admin.com

Contraseña: admin2021