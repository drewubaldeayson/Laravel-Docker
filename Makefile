setup:
	mkdir -p ./storage/framework/sessions
	mkdir -p ./storage/framework/cache
	mkdir -p ./storage/framework/testing
	mkdir -p ./storage/framework/views
	docker volume create --name=humite-be-db-data
install:
	docker-compose -f docker-compose.builder.yml run --rm install
migrate:
	docker-compose -f docker-compose.builder.yml run --rm migrate
build:
	docker-compose -f docker-compose.builder.yml run --rm build
reset-config:
	rm -rf ./storage/framework/views/*
	docker-compose run --rm humite-backend php artisan route:clear
	docker-compose run --rm humite-backend php artisan view:clear
	docker-compose run --rm humite-backend php artisan config:cache
	docker-compose run --rm humite-backend php artisan config:clear
queue-reload:
	docker-compose run --rm humite-backend php artisan queue:restart
	sudo service humite-queue restart
seed:
	docker-compose run --rm humite-backend php artisan db:seed
test:
	docker-compose run --rm humite-backend php artisan test
destroy:
	docker-compose -f docker-compose.builder.yml down --volumes
	docker volume rm humite-be-db-data
	rm -rf ./vendor
	rm -rf ./containerization/db-data
	mkdir ./containerization/db-data
dev:
	docker-compose up
detach:
	docker-compose up --build -d