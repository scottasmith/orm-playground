# Intro
This is a Doctrine ORM playground mixed in with the [Laminas ServiceManager](https://docs.laminas.dev/laminas-servicemanager)

# Installation
This demo requires Docker to be installed and set up. You need to create the volumes then you can bring up the container:
```shell script
$ docker volume create demo-mysql-data
$ docker volume create composer-cache
$ docker volume create npm-cache
$ docker volume create yarn-cache
$ docker-compose up -d
```

## MySQL
There is a contained MySQL instance using the docker volume `demo-mysql-data`.
You can connect to MySQL on 127.0.0.1 with port 3307
```shell script
$ mysql -h127.0.0.1 -P 3307 -uroot -p
```
The password in the `.env` is secret

## Application setup
When the container is up you can exec into it:
```shell script
$ docker exec -it orm_web_1 bash
```

Then install composer packages and run migrations:
```shell script
$ composer install
$ bin/console migration:migrate
```

# Test commands
There are some test commands to create and get a user:
```shell script
$ bin/console user:create
$ bin/console user:get
```

# Doctrine Migrations
To create a migration type inside the container:
```shell script
$ bin/console migration:generate --namespace App\\DoctrineMigrations
```

This creates a migration in `modules/App/doctrine_migrations/`.
The namespace `App\\DoctrineMigrations` mapping is set-up in `modules/App/config/doctrine.php 
