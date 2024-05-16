# Laravel Docker Template

## Description

Template

## Getting Started

### Dependencies

* Docker
* Docker Composer
* Make

### Installing

* Check Environmental Variables before you proceed.
* Make sure all of the variables are ready especially in Docker Environments.
* You may check the .env.example for reference.

### Executing program

* Here are some of the make commands you may use for the project.

* For setup before proceeding to installation

FIRST
cp.env.example .env

SECOND
cd storage/
mkdir -p framework/{sessions,views,cache}
chmod -R 775 framework

# install
docker-compose run --rm andrewayson-laravel-backend composer install

# build
docker-compose run --rm andrewayson-laravel-backend bash -c "chmod -R 777 storage && php artisan key:generate"

# migrate 
docker-compose run --rm andrewayson-laravel-backend php artisan migrate

# reset-config
docker-compose run --rm andrewayson-laravel-backend php artisan route:clear
docker-compose run --rm andrewayson-laravel-backend php artisan view:clear
docker-compose run --rm andrewayson-laravel-backend php artisan config:cache
docker-compose run --rm andrewayson-laravel-backend php artisan config:clear

# seed
docker-compose run --rm andrewayson-laravel-backend php artisan db:seed

# test
docker-compose run --rm andrewayson-laravel-backend php artisan test

# destroy
docker-compose down --volumes
docker volume rm andrewayson-laravel-be-db-data

# dev up
docker-compose up

# detach up
docker-compose up --build -d



## Help

Please ping me or just give me a heads up for any issues encountered.


## Authors

Contributors names and contact info

Andrew Ayson <br/>


## Version History

* 0.1
    * Initial Release

## License

N O N E
