# Prueba Técnica Desarrollador PHP Laravel
## Descripción


Aplicación web con las funcionalidades de:

- Dar alta un post.
- Ver el contenido de un post.
- Listado de posts
- Filtrar por titulo, contenido o autor de un  post.
- Autenticación, registro, inicio de sesión y cerrado de sesión.

## Tecnologías utilizadas

- Laravel 9
- PHP 8
- JQuery 3.6.3
- AJAX
- Bootstrap 5
- Composer 

## Instalación

-Tomar en cuenta el entorno que se correra el aplicativo, fue desarrollado en un entorno Windows utilizando la herramienta de XAMPP.
- Clonar el repositorio (git clone https://github.com/josefernandoperezgarcia1998/grupopromass-prueba-tecnica.git).
 - Situarse en la carpeta del proyecto.
 - Abrir una terminal dentro del proyecto e instalar las dependencias con el comando "composer install".
 - Abrir el archivo .env para configurar las variables de entorno para la base de datos.
 - Una vez teniendo la base de datos se procederá a ejecutar en la terminal dentro del proyecto el siguiente comando "php artisan migrate --seed" para cargar las migraciones y seedeers en la base de datos; se crearán usuarios y posts de manera aleatoria.
 - Ya con la base de datos lista y cargada con información, se procede a ejecutar el comando "php artisan serve" para poder correr el servidor local y hacer uso del aplicativo.
 -Laravel ofrecerá una URL local para esto, por lo general es "http://127.0.0.1:8000/", con esa dirección se puede acceder desde el navegador.
