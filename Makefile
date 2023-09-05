up:
	@docker-compose up --build

down:
	@docker-compose down

webserver.sh:
	@docker-compose exec webserver /bin/sh

core.sh:
	@docker-compose exec core /bin/sh

webapp.sh:
	@docker-compose exec webapp /bin/sh