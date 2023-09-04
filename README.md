<h1 align="center"> Prueba técnica Serempre</h1>

 <p align="center">
   <img src="https://img.shields.io/badge/STATUS-EN%20DESAROLLO-green">
</p>

##Índice

- [Acceso al proyecto](#acceso-proyecto)

- [Tecnologías utilizadas](#tecnologías-utilizadas)

- [Consideraciones](#tecnologías-utilizadas)

## Acceso al proyecto

En la raiz del proyecto hay un directorio llamado **docs** que contiene el archivo base para realizar el proceso del
importador y la coleccion en postman para probar los endpoints creados de acuerdo a la prueba y que estan descritos en los
puntos:  

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

6. Instalar el paquete para la autenticacion con JWT
    ```
    composer require tymon/jwt-auth
    ``` 

    - Luego ejecutar el siguiente comando
    ```
    php artisan jwt:secret
    ``` 

6. Ubicados en la raiz del proyecto ejecutar el siguiente comando **composer install** instalarà los paquetes(dependencias) que requiere el proyecto definidos en el archivo *composer.json*

7. En caso de presentarse algun error por incompatibilidad de los paquetes ejecutar el siguiente comando **composer update**


8. Una vez realizados los pasos anteriores de debe crear una base de datos local para esta prueba se utiliza *Mysql* que se llame **serempre** agregando los datos de conexiòn en el archivo .env, en las siguientes variables:
    ```
    *DB_DATABASE=serempre
    *DB_USERNAME=
    *DB_PASSWORD=
    ```

9. Ejecutar el siguiente comando para realizar las migraciones y seeders en la BD 
    ```
    php artisan db:run-migrate-and-seeder
    ```

10. Para iniciar el servidor y correr el proyecto ejecutar el siguiente comando
    ```
    php artisan serve --host=127.0.0.1 --port=8080
    ```
   
11. Proceso de registro de un usuario adicional una vez se realiza el registro se implementa un observador para
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
   
    **Respuesta**
    ```
    {
        "data": {
            "type": "user",
            "id": "21",
            "attributes": {
                "name": "Jonathan Olivera",
                "email": "jonathan.guerrero.olivera@gmail.com"
            }
        }
    }
    ```

12. Ejecutar los demas servicios del CRUD

    - **Read**
    ```
    curl --location --request GET 'http://127.0.0.1:8000/api/users/9'
    ```
    
    Respuesta
    ```
    {
        "data": {
            "type": "user",
            "id": "3",
            "attributes": {
                "name": "Kole Wiza",
                "email": "dfeest@example.org"
            }
        }
    }
    ```

    - **Update**
    ```
    curl --location --request PUT 'http://127.0.0.1:8000/api/users/9' \
    --header 'Content-Type: application/json' \
    --data-raw '{
        "name": "Jorge Mendez",
        "password": "a.df7392",
        "email": "jorgem@gmail.com"
    }'
    ```

    Respuesta
    ```
    {
        "data": {
            "type": "user",
            "id": "3",
            "attributes": {
                "name": "Kole Wiza",
                "email": "dfeest@example.org"
            }
        }
    }
    ```

    - **Delete**
    ```
    curl --location --request DELETE 'http://127.0.0.1:8000/api/users/10'
    ```

    Respuesta
    ```
    {
        "data": {
            "message": "Registro eliminado con éxito."
        }
    }
    ```

13. Paginacion
    ```
    curl --location --request GET 'http://127.0.0.1:8000/api/cities?page=2&per_page=5'
    ```
    
    Respuesta
    ```
    {
        "data": [
            {
                "type": "cities",
                "id": "2",
                "attributes": {
                    "code": "2IOVgttTif",
                    "name": "Medellin"
                }
            }
        ],
        "meta": {
            "pagination": {
                "total": 10,
                "count": 1,
                "per_page": 1,
                "current_page": 2,
                "total_pages": 10
            }
        },
        "links": {
            "self": "http://127.0.0.1:8000/api/cities?page=2",
            "first": "http://127.0.0.1:8000/api/cities?page=1",
            "prev": "http://127.0.0.1:8000/api/cities?page=1",
            "next": "http://127.0.0.1:8000/api/cities?page=3",
            "last": "http://127.0.0.1:8000/api/cities?page=10"
        }
    }
    ```
    
14. Vista para importar archivo con el listado de clientes
    - Importar archivo de cleintes
    ```
    [GET] http://127.0.0.1:8000/clients/import
    ```
    archivo con el listado de clientes: https://docs.google.com/spreadsheets/d/16cCPCNXdaHAsOLZwBSGFfGRhK8S9yts2JdL1bHTa9oQ/edit?usp=sharing

    - Exportar el listado de clientes ejecutar en el navegador la siguiente URL
    ```
    [GET] http://127.0.0.1:8000/clients/export
    ```

15. Listar clientes de acuerdo a una ciudad
    ```
    curl --location --request GET 'http://127.0.0.1:8000/api/clients?city=Bogota'
    ```

    ```
    {
        "data": [
            {
                "type": "clients",
                "id": "2",
                "attributes": {
                    "code": "564744337",
                    "name": "Serenity Lind",
                    "city": "Bogota"
                }
            },
            {
                "type": "clients",
                "id": "5",
                "attributes": {
                    "code": "996446490",
                    "name": "Dedric Hahn",
                    "city": "Bogota"
                }
            },
            {
                 "type": "clients",
                 "id": "7",
                 "attributes": {
                     "code": "728648609",
                     "name": "Rahul Rippin DVM",
                     "city": "Bogota"
                }
            }
        ],
        "meta": {
            "pagination": {
                "total": 3,
                "count": 3,
                "per_page": 3,
                "current_page": 1,
                "total_pages": 1
            }
        },
        "links": {
            "self": "/?page=1",
            "first": "/?page=1",
            "last": "/?page=1"
        }
    }
    ```
    
16. Login con generador de token para autenticacion
    ```
    curl --location --request POST 'http://127.0.0.1:8000/api/auth/login' \
    --header 'Content-Type: application/json' \
    --header 'Cookie: XSRF-TOKEN=eyJpdiI6InQ2M3gwNlNFWTB1bk84MTNEOUJaUUE9PSIsInZhbHVlIjoiZ1hYa0FxSCtsSXQyczBueXpka0xNT1BtYk01enVkOWw0Um5YV3JVUzFDaWFqTW9BR3RWSjl3eDMvOHpSZ2dkb1pKRStYL2xzOFcyeitXRDNyYU1RdStRYkxqdkZlVGtCLzRZK1JYVC9oeGx4QWw5Q2VtVVplZzlrVVg2elBwemUiLCJtYWMiOiJlYWYyMzdiNjhmYTNlZjI2MTlmMWFkMjNkOWE0YmUxMDM4OTk2NjBmOWU3YWM2ZTI1OWY3YTBkZTQ0Yjk5OTc2IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImtRcFRCUkUxWXkwdVhBOHFORWk0bWc9PSIsInZhbHVlIjoiYUJEdUNpYVhRT09lMDd1VTdYZXF3empiOVFNN2JydnNydjY5WExvNjdZYWgwS0lldk1sdnVBSEJRdWtnNmRvKzljYTlJM0NLYlBLMnVwc2NtSXZKbDdpYzdtdVk0UDdFWEFycGpKVUF5U0d2eXdVMmlhaGRONHJTdWdIeUluS2EiLCJtYWMiOiIwYmIyOGJmNzA3MjA0ZDE0NzBiZDczYmU1OWYxZGE3ZThhODhlOWQ2ZTFjYjBkZTFmNDJjNmYyZjJmZDg5MDY0IiwidGFnIjoiIn0%3D' \
    --data-raw '{
    "email": "jorgep@gmail.com",
    "password": "12345"
    }'
    ```

    Respuesta
    ```
    {
        "data": {
            "type": "userToken",
            "id": "9",
            "attributes": {
                "name": "Felipe Puertas",
                "email": "jorgep@gmail.com"
            },
            "relationships": {
                "token": {
                    "data": {
                        "type": "token",
                        "id": "9"
                    }
                }
            }
        },
        "included": [
            {
                "type": "token",
                "id": "9",
                "attributes": {
                    "value": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2OTM4MTM4NzIsImV4cCI6MTY5MzgxNzQ3MiwibmJmIjoxNjkzODEzODcyLCJqdGkiOiI2Mlp4d0tWbTVBY2R5OURIIiwic3ViIjoiOSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.aHvwhn71L4FwdfpNL_16xMeckpAJ02NqoxP-X-KCLsU"
                }
            }
        ]
    }
    ```
        
17. Consultar informacion de un usuario solicitando el token para autenticacion
    ```
    curl --location --request GET 'http://127.0.0.1:8000/api/user/info' \
    --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2OTM4MDk3NTIsImV4cCI6MTY5MzgxMzM1MiwibmJmIjoxNjkzODA5NzUyLCJqdGkiOiJxOTE4eDlzeHpCNGEyU3BxIiwic3ViIjoiOSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.Jn0AyulA3SSwwKIQUmZBAy5Rw0Tw7gv5jrBcCl7MZ9I' \
    --header 'Cookie: XSRF-TOKEN=eyJpdiI6InQ2M3gwNlNFWTB1bk84MTNEOUJaUUE9PSIsInZhbHVlIjoiZ1hYa0FxSCtsSXQyczBueXpka0xNT1BtYk01enVkOWw0Um5YV3JVUzFDaWFqTW9BR3RWSjl3eDMvOHpSZ2dkb1pKRStYL2xzOFcyeitXRDNyYU1RdStRYkxqdkZlVGtCLzRZK1JYVC9oeGx4QWw5Q2VtVVplZzlrVVg2elBwemUiLCJtYWMiOiJlYWYyMzdiNjhmYTNlZjI2MTlmMWFkMjNkOWE0YmUxMDM4OTk2NjBmOWU3YWM2ZTI1OWY3YTBkZTQ0Yjk5OTc2IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImtRcFRCUkUxWXkwdVhBOHFORWk0bWc9PSIsInZhbHVlIjoiYUJEdUNpYVhRT09lMDd1VTdYZXF3empiOVFNN2JydnNydjY5WExvNjdZYWgwS0lldk1sdnVBSEJRdWtnNmRvKzljYTlJM0NLYlBLMnVwc2NtSXZKbDdpYzdtdVk0UDdFWEFycGpKVUF5U0d2eXdVMmlhaGRONHJTdWdIeUluS2EiLCJtYWMiOiIwYmIyOGJmNzA3MjA0ZDE0NzBiZDczYmU1OWYxZGE3ZThhODhlOWQ2ZTFjYjBkZTFmNDJjNmYyZjJmZDg5MDY0IiwidGFnIjoiIn0%3D'
    ```
    
18. Actualizar informacion de un usuario solicitando el token para autenticacion
    ```
    curl --location --request POST 'http://127.0.0.1:8000/api/user/info' \
    --header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2OTM4MDk3NTIsImV4cCI6MTY5MzgxMzM1MiwibmJmIjoxNjkzODA5NzUyLCJqdGkiOiJxOTE4eDlzeHpCNGEyU3BxIiwic3ViIjoiOSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.Jn0AyulA3SSwwKIQUmZBAy5Rw0Tw7gv5jrBcCl7MZ9I' \
    --header 'Content-Type: application/json' \
    --header 'Cookie: XSRF-TOKEN=eyJpdiI6InQ2M3gwNlNFWTB1bk84MTNEOUJaUUE9PSIsInZhbHVlIjoiZ1hYa0FxSCtsSXQyczBueXpka0xNT1BtYk01enVkOWw0Um5YV3JVUzFDaWFqTW9BR3RWSjl3eDMvOHpSZ2dkb1pKRStYL2xzOFcyeitXRDNyYU1RdStRYkxqdkZlVGtCLzRZK1JYVC9oeGx4QWw5Q2VtVVplZzlrVVg2elBwemUiLCJtYWMiOiJlYWYyMzdiNjhmYTNlZjI2MTlmMWFkMjNkOWE0YmUxMDM4OTk2NjBmOWU3YWM2ZTI1OWY3YTBkZTQ0Yjk5OTc2IiwidGFnIjoiIn0%3D; laravel_session=eyJpdiI6ImtRcFRCUkUxWXkwdVhBOHFORWk0bWc9PSIsInZhbHVlIjoiYUJEdUNpYVhRT09lMDd1VTdYZXF3empiOVFNN2JydnNydjY5WExvNjdZYWgwS0lldk1sdnVBSEJRdWtnNmRvKzljYTlJM0NLYlBLMnVwc2NtSXZKbDdpYzdtdVk0UDdFWEFycGpKVUF5U0d2eXdVMmlhaGRONHJTdWdIeUluS2EiLCJtYWMiOiIwYmIyOGJmNzA3MjA0ZDE0NzBiZDczYmU1OWYxZGE3ZThhODhlOWQ2ZTFjYjBkZTFmNDJjNmYyZjJmZDg5MDY0IiwidGFnIjoiIn0%3D' \
    --data-raw '{
    "name": "Felipe Puertas"
    }'
    ```
    
## Tecnologias usadas

- [Mailtrap](https://mailtrap.io/)
- [fractal](https://fractal.thephpleague.com/)
- [Laravel Excel](https://docs.laravel-excel.com/3.1/getting-started/installation.html)

## Consideraciones

- La version de PHP sobre la cual se realizò esta prueba es la versiòn 8
- Al crear los nuevos directorios y archivos se procura seguir con el planteamiento de clean architecture
- Como objeto que pasa la informaciòn entre una capa y otra se creo un DTO
- Se implementa el patron repository para las operaciones con la BD
- Se tiene en cuenta para el desarrollo de esta prueba los planteamientos del principio SOLID
- Se implementa el marco de git flow para trabajar con el repositorio y la creaciòn de las ramas
- La respuesta(JSON) generadas por el servicio que se expone cumple con lo indicado por el estandar [JsonAPI](https://jsonapi.org/)
