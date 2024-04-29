<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre este proyecto

Este proyecto representa una API REST construida con Laravel. He implementado un sistema de autenticación personalizado para garantizar la seguridad y el acceso adecuado a todos los servicios.

## Tecnología Utilizada:

- Laravel (Versión 11): He utilizado la última versión de Laravel para desarrollar esta API,      aprovechando sus características avanzadas y su robusta arquitectura.

## Requerimientos

- Version de PHP ^8.2
- Composer

## Instalacion pasos

- Ejecuta el comando 'composer i' para instalar las dependencias del proyecto.
- Ejecutar el comando 'cp .env.example .env' para crear el .env desde el .env.example.
- Ejecurar el comando 'php artisan key:generate' para generar la clave de la aplicación.
- Configurar la conexion a la base de datos.
- Ejecuta el comando 'php artisan migrate --seed' para crear las tablas en la base de datos y para añadir registros de prueba.
- Ejecuta el comando 'php artisan serve' para habilitar el servidor en local.

## Documentación

- [Documentacion de la API con Postman](https://carlosjaramillo.beauty/download/Prueba%20tecnica%20API%20REST%20Laravel.postman_collection.zip)