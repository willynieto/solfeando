# Plataforma Fincas

## Este sitio usa Laravel Framework 10

##### Es importe antes de iniciar saber que es necesario:
    - php: 8.1.* (Minimo)
    - composer: 2.* (Recomendado)
    - MySQL 8.0 (Minimo)

##### Despues abra una consola y ejecute:
      \>: composer update
      
##### Ruta para ejecutar las tareas programadas o schedules
	/usr/local/bin/ea-php73 /home/*nombre de usuario del servidor*/public_html/public/artisan schedule:run >> /dev/null 2>&1
      
##### Para iniciar el proyecto:
      http://127.0.0.1/plataformafincas/public
      
##### Recuerde importar el script SQL y cambiar los datos de conexion en el archivo .env
      /plataformafincas/.env      

## Acerca del modelo UML, respaldo de la BD y diccionario de datos
##### En este directorio
         plataformafincas/database