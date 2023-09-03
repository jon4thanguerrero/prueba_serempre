<h1 align="center"> Prueba técnica Serempre</h1>

 <p align="center">
   <img src="https://img.shields.io/badge/STATUS-EN%20DESAROLLO-green">
</p>

##Índice

- [Acceso al proyecto](#acceso-proyecto)

- [Tecnologías utilizadas](#tecnologías-utilizadas)

## Acceso al proyecto

1. Clonar el repositorio a travès del siguiente enlace
    ```
    https://github.com/jon4thanguerrero/prueba_serempre.git
    ```

2. Tener instalado el manejador de paquetes para PHP composer
    ```
    https://getcomposer.org/doc/00-intro.md
    ```

3. Instalar el framework Laravel 
    ```
    https://laravel.com/docs/9.x/installation
    ```
   
4. Instalar fractal
    ```
    https://fractal.thephpleague.com/installation/
    ```

5. Instalar paquete para procesar archivos de excel
    ``` 
    https://docs.laravel-excel.com/3.1/getting-started/installation.html
    ```

6. Ubicados en la raiz del proyecto ejecutar el siguiente comando **composer install** instalarà los paquetes(dependencias) que requiere el proyecto definidos en el archivo *composer.json*


7. Una vez realizados los pasos anteriores de debe crear una base de datos local para esta prueba se utiliza *Mysql* que se llame **serempre** agregando los datos de conexiòn en el archivo .env, en las siguientes variables:
    ```
    *DB_DATABASE=serempre
    *DB_USERNAME=
    *DB_PASSWORD=
    ```

8. Ejecutar el siguiente comando para realizar las migraciones y seeders en la BD 
    ```
    php artisan db:run-migrate-and-seeder
    ```

9. Para iniciar el servidor y correr el proyecto ejecutar el siguiente comando
    ```
    php artisan serve --host=127.0.0.1 --port=8080
    ```
   
10. Proceso de registro de un usuario adicional una vez se realiza el registro se implementa un observador para
   el envio de un email.

   ```
   curl --location --request POST 'http://127.0.0.1:8000/api/users' \
   --header 'Content-Type: application/json' \
   --data-raw '{
   "name": "Carlos cortez",
   "password": "qweqr",
   "email": "prueba@gmail.com"
   }'
   ```

11. Ejecutar los demas servicios del CRUD

    **Read**
    ```
    curl --location --request GET 'http://127.0.0.1:8000/api/users/9'
    ```

    **Update**
    ```
    curl --location --request PUT 'http://127.0.0.1:8000/api/users/9' \
    --header 'Content-Type: application/json' \
    --data-raw '{
        "name": "Jorge Mendez",
        "password": "a.df7392",
        "email": "jorgem@gmail.com"
    }'
    ```

    **Delete**
    ```
    curl --location --request DELETE 'http://127.0.0.1:8000/api/users/10'
    ```

12. Paginacion
    ```
    curl --location --request GET 'http://127.0.0.1:8000/api/cities?page=2&per_page=5'
    ```
    
13. Vista para importar archivo con el listado de clientes
    ```
    http://127.0.0.1:8000/clients/import
    ```
    archivo con el listado de clientes: https://docs.google.com/spreadsheets/d/16cCPCNXdaHAsOLZwBSGFfGRhK8S9yts2JdL1bHTa9oQ/edit?usp=sharing

14. Listar clientes de acuerdo a una Ciudad
    ```
    curl --location --request GET 'http://127.0.0.1:8000/api/clients?city=Bogota'
    ```

## Tecnologias usadas

- [Mailtrap](https://mailtrap.io/)
- [fractal](https://fractal.thephpleague.com/)

## Consideraciones

- La version de PHP sobre la cual se realizò esta prueba es la versiòn 8
- Al crear los nuevos directorios y archivos se procura seguir con el planteamiento de clean architecture
- Como objeto que pasa la informaciòn entre una capa y otra se creo un DTO
- Se implementa el patron repository para las operaciones con la BD
- Se tiene en cuenta para el desarrollo de esta prueba los planteamientos del principio SOLID
- Se implementa el marco de git flow para trabajar con el repositorio y la creaciòn de las ramas
- La respuesta(JSON) generadas por el servicio que se expone cumple con lo indicado por el estandar [JsonAPI](https://jsonapi.org/)  

