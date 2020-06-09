#Installation
This demo requires Docker to be installed and set up.

##Docker Volumes
```shell script
$ docker volume create demo-mysql-data
$ docker volume create composer-cache
$ docker volume create npm-cache
$ docker volume create yarn-cache
```

##MySQL
You can connect to MySQL on 127.0.0.1 with port 3307
```shell script
$ mysql -h127.0.0.1 -P 3307 -uroot -p
```

The default password in the `.env` is secret

##Composer and Migrations
Exec into the docker container and type:
```shell script
$ composer install
$ bin/console migration:migrate
```

#Console
Exec into the docker container and type:
```shell script
$ bin/console
..
$ bin/console user:create
$ bin/console user:get
```

#Doctrine Migrations
To create a migration type inside the container:
```shell script
$ bin/console migration:generate --namespace App\\DoctrineMigrations
```

This creates a migration in `modules/App/doctrine_migrations/`
