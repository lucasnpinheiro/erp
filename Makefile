install:
	@docker compose up -d --build

up:
	@docker compose up -d

down:
	@docker compose down

restart:
	@make down
	@make up

sh:
	@docker compose exec php sh

test:
	@docker compose exec php composer run test