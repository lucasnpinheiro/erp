install:
	@docker compose up -d --build

up:
	@docker compose up -d

down:
	@docker compose down

restart:
	@make up
	@make down

sh:
	@docker compose exec php bash

test:
	@docker compose exec php vendor/bin/phpunit --coverage-html coverage tests