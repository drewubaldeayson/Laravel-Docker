setup:
	mkdir -p ./storage/framework/sessions
	mkdir -p ./storage/framework/cache
	mkdir -p ./storage/framework/testing
	mkdir -p ./storage/framework/views
	docker volume create --name=andrewayson-laravel-be-db-data
install:
	docker-compose -f docker-compose.builder.yml run --rm install
migrate:
	docker-compose -f docker-compose.builder.yml run --rm migrate
build:
	docker-compose -f docker-compose.builder.yml run --rm build
reset-config:
	rm -rf ./storage/framework/views/*
	docker-compose run --rm andrewayson-laravel-backend php artisan route:clear
	docker-compose run --rm andrewayson-laravel-backend php artisan view:clear
	docker-compose run --rm andrewayson-laravel-backend php artisan config:cache
	docker-compose run --rm andrewayson-laravel-backend php artisan config:clear
queue-reload:
	docker-compose run --rm andrewayson-laravel-backend php artisan queue:restart
	sudo service andrewayson-laravel-queue restart
seed:
	docker-compose run --rm andrewayson-laravel-backend php artisan db:seed
test:
	docker-compose run --rm andrewayson-laravel-backend php artisan test
destroy:
	docker-compose -f docker-compose.builder.yml down --volumes
	docker volume rm andrewayson-laravel-be-db-data
	rm -rf ./vendor
	rm -rf ./containerization/db-data
	mkdir ./containerization/db-data
dev:
	docker-compose up
detach:
	docker-compose up --build -d