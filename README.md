# simple basket app with laravel

## Installation
1. Clone Project
> `git clone git@github.com:tmlsergen/simple_basket.git`
2. Copy .env file
> `cp .env.example .env`
3. Starting Docker Containers
> `docker-compose up`
4. You can see the working containers with `docker ps`
```
 
CONTAINER ID   IMAGE              COMMAND                  CREATED        STATUS        PORTS                                      NAMES
3cfee25e3f7c   redis:latest       "docker-entrypoint.s…"   38 hours ago   Up 38 hours   0.0.0.0:6379->6379/tcp                     basket-redis_redis_1
099e82cab49e   nginx:alpine       "/docker-entrypoint.…"   38 hours ago   Up 38 hours   0.0.0.0:80->80/tcp, 0.0.0.0:443->443/tcp   basket-redis_webserver_1
871da58a688b   basket-redis_app   "docker-php-entrypoi…"   38 hours ago   Up 38 hours   9000/tcp                                   basket-redis_app_1
739a6e6bf81c   mysql:8            "docker-entrypoint.s…"   38 hours ago   Up 38 hours   0.0.0.0:3306->3306/tcp, 33060/tcp          basket-redis_db_1

```
5. To install composer dependencies
> `docker exec -ti app_container_id composer install`
6. Generate the laravel app key
> `docker exec -ti app_container_id php artisan key:generate`
7. You can access container bash with
> `docker exec -ti app_container_id bash`

# Environments
.env db connection on container
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=basket_db
DB_USERNAME=root
DB_PASSWORD=root
```

When you start the containers add the line below on `/etc/hosts` file for local development
>`127.0.0.1       basket.test`
