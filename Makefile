build: docker-build up dependencies

compose := docker-compose -f ./.docker/docker-compose.yml

docker-build:
	$(compose) build

up:
	$(compose) up -d

down:
	$(compose) down

dependencies:
	$(compose) exec -T fpm composer install