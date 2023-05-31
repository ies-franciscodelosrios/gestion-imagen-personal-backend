# Levanta la arquitectura

file_selected := -f docker-compose.$(env).yml
environment := $(env)

up:
	@docker-compose $(file_selected) up -d

ps:
	@docker-compose $(file_selected) ps

down:
	@docker-compose $(file_selected) down

build:
	@docker-compose $(file_selected) build $(c)

restart:
	@docker-compose $(file_selected) restart $(c)

logs:
	@docker-compose $(file_selected) logs -f $(c)

logs_php:
	@docker-compose $(file_selected) exec -T laravel tail -f storage/logs/laravel.log

connect:
	@docker-compose $(file_selected) exec laravel bash

connect_root:
	@docker-compose $(file_selected) exec -u root laravel bash

install: up install_dependencies cache_clear migrate_database seed_database

install_dependencies:
	@docker-compose $(file_selected) exec -T laravel composer install

cache_clear: up
	@docker-compose $(file_selected) exec -T laravel php artisan cache:clear
	@docker-compose $(file_selected) exec -T laravel php artisan view:clear
	@docker-compose $(file_selected) exec -T laravel php artisan config:clear
	@docker-compose $(file_selected) exec -T laravel chown -R www-data:www-data storage/
	@docker-compose $(file_selected) exec -T laravel chmod 755 -R storage/

migrate_database: up
	@docker-compose $(file_selected) exec -T laravel php artisan migrate
 
seed_database:
	@docker-compose $(file_selected) exec -T laravel php artisan db:seed

pull_code:
	git checkout develop
	git pull

deploy: down pull_code up install_dependencies cache_clear migrate_database
