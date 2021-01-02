# Prueba viajemos.com

Dentro de este repositorio, se dejo consignado el proceso de creación de la prueba, cada unos de los avances estan registrados en el repositorio y la estructura aqui presentada es basada en Docker.

La aplicación se encuentra en la carpeta **public/viajemos.com** usa como base el framework **Laravel 8** y tiene una estructura  d tipo MVC, y expone una API rest.

## Requisitos 

        Docker version 19.03.11, build 42e35e61f3
        
        docker-compose version 1.17.1, build unknown

        git version 2.17.1

## Estructura del proyecto

        /clienteapi 
           /cliente_api_library
        
        /databases 
            docker-compose.yml 
            example.env 
            mysql 
            readme.md

        /database_backup 
            library.sql

        /nginx_base_tviajemos.com
            /config 
            docker-compose.yml 
            example.env 
            readme.md 

        /public_html
            /viajemos.com

        /php
            /php-fpm 
                Dockerfile
            docker-compose.yml 
            example.env 
            readme.md

        Readme.md

# Como iniciar 

Dentro de las carpetas **databases**, **nginx_base_viajemos.com**, **php** existen archivos **.env** que son los encargados de registrar los archivos, donde debera registar los puertos de configuración, una vez agregado los puertos, debera iniciar los contenedores desde las carpetas mencionadas usando en cada carpeta el siguiente comando 

    docker-compose up -d 

# Cliente web

El proyecto cuenat con un clienet web construido en **Vue.js 3**, el cual puede ser iniciado desde la carpeta **cliente_api/cliente_api_library**, una vez allí ejecute el sigueinte comando asegurese de tener instalado node y npm

    npm install

    npm run serve

