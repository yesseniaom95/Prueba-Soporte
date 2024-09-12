
# Prueba-Soporte
Desarrollo de prueba técnica.

# Prueba Técnica - Sistema de Gestión de Tareas

## Descripción del Proyecto

Este proyecto es un sistema básico de gestión de tareas desarrollado con Laravel y Vue.js. El objetivo de esta prueba técnica es identificar y corregir errores en el código tanto en el backend como en el frontend. El sistema permite a los usuarios crear, actualizar, eliminar y visualizar tareas.

## Objetivo de la Prueba

El objetivo principal de esta prueba es evaluar tus habilidades para depurar y corregir errores en un proyecto existente que utiliza Laravel, PHP, JavaScript, y Vue.js. Deberás:

- Identificar y corregir errores en el backend relacionado con la creación, actualización, eliminación y validación de tareas.
- Corregir problemas en el frontend que afectan la visualización y manejo de la lista de tareas.
- Asegurarte de que las tareas se gestionen correctamente en la interfaz de usuario.

Además, deberás agregar una funcionalidad extra para filtrar las tareas completadas y pendientes.

## Instrucciones de Instalación

Sigue los siguientes pasos para configurar el proyecto en tu entorno local:


1. **Clona el repositorio:**

       Prueba-Soporte
   
2. **Instala las dependencias de PHP y Node.js:**

   .Composer: Para instalar las dependencias de PHP, ejecuta:
   
        composer install

   .NPM: Para instalar las dependencias de Node.js, ejecuta:

        npm install
        npm run dev

3. **Configura el archivo de entorno .env:**

   .Copia el archivo .env.example a .env:

       cp .env.example .env
   
   .Genera la clave de la aplicación:

       php artisan key:generate
   
   .Configura la base de datos en el archivo .env. Asegúrate de tener una base de datos MySQL disponible y configurada.
   
4. **Ejecuta las migraciones para crear las tablas necesarias:**

       php artisan migrate

5. **Compilar Recursos de Frontend:**

   .Compila los archivos de frontend utilizando Laravel Mix:

       npm run dev

6. **Iniciar el Servidor:**

   .Inicia el servidor de desarrollo de Laravel:

       php artisan serve

       
**Objetivo de la Prueba**

El proyecto contiene errores tanto en el backend (Laravel/PHP) como en el frontend (JavaScript). Tu objetivo es:

 1.Identificar los errores en el código.
 2.Corregir los errores para que la aplicación funcione correctamente.
 3.Probar la aplicación después de realizar las correcciones para asegurarte de que todo funcione como se espera.
 
**Entrega**

Sube el código corregido a un repositorio de GitHub y envíanos el enlace. Asegúrate de describir los problemas que encontraste y cómo los solucionaste en este archivo README.md.

**Notas**

Puedes añadir cualquier comentario adicional sobre las decisiones que tomaste al corregir el código.
Recuerda que el objetivo es demostrar tu capacidad para depurar y mejorar código existente.

¡Buena suerte!
   
## Solución

1. Realice la instalación de Docker para evitar inconvenientes de versiones.
2. La ejecución seria la siguiente: Cambiar nombre del archivo raiz "envarioment" a .env
3. Ejecutar "docker compose build" o "docker-compose build".
4. Ejecutar "docker compose up" o "docker-compose up". (Para levantar los contenedores).
5. Ejecutar “docker compose ps ” o “docker-compose ps”. (Para ver los contenedores).
6. Ejecutar: “docker compose exec app rm -rf vendor composer.lock ” o “docker compose exec app rm -rf vendor composer.lock ”. (Para remover archivos viejos, si existen de la carpeta vendor).
7. Ejecutar: “docker compose exec app composer install” o “docker-compose exec app composer install” (Para instalar las dependencias de app, LARAVEL).
8. Ejecutar: “docker compose exec app php artisan key:generate” o “docker-compose exec app php artisan key:generate” (Para generar el key en de la app, LARAVEL).
9.	Ejecutar: “docker compose exec app php artisan migrate” o “docker-compose exec app php artisan migrate” (Para generar las migraciones a nuestra base de datos MYSQL de la app).
10.	Ejecutar: “npm install” (Para instalar  las dependencias de vue a nuestra app).
11.	Ejecutar: “npm run dev” (Para generar nuevos cambios de vue a nuestra app) o . “npm run watch” (Para generar y mantener activo la detección de los nuevos cambios de vue a nuestra app).
12.	Ejecutar: “docker compose down ” o “docker-compose down”. (Para apagar los contenedores).

Contenedores Docker:

A continuación se describen los contenedores creados por docker para el correcto uso de la App Laravel.

1.	app: Es el contenedor para Laravel (Cuenta con PHP 7.4).
2.	db: Es el contenedor de nuestra base de datos MySql, version 8. (Por defecto cuenta con las siguientes credenciales:  MYSQL_DATABASE: laravelapp, MYSQL_ROOT_PASSWORD: password,  MYSQL_PASSWORD: password,MYSQL_USER: laravelapp_user).
3.	Nginx: Es el contenedor que nos servirá como servicio para escuchar las peticiones http en el puerto 8000 y balancearlas a nuestro servicio app  (Laravel, puerto 80)

Nota: Se implementaron rutas en el router/api.php con el objetivo de realizar ajustes especificos en el controlador. En este caso, no se utilizaton los métodos convencionales como store. update y destroy, ya que era necesario que las respuestas fueran devueltas en formato JSON en lugar de la vista.

