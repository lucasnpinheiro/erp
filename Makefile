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
	@docker compose exec php sh

test:
	@docker compose exec php vendor/bin/phpunit --colors=auto --coverage-html tests/coverage/ tests