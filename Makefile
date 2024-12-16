# Makefile for Docker Laravel Project
include .env

# Variables
DOCKER_COMPOSE = docker-compose

# Commands
.PHONY: build up down restart logs artisan composer bash

build:
	$(DOCKER_COMPOSE) build
up:
	$(DOCKER_COMPOSE) up -d
down:
	$(DOCKER_COMPOSE) down
restart:
	$(DOCKER_COMPOSE) down && $(DOCKER_COMPOSE) up -d
logs:
	$(DOCKER_COMPOSE) logs -f
artisan:
	$(DOCKER_COMPOSE) exec php php artisan $(cmd)
composer:
	$(DOCKER_COMPOSE) exec php composer $(cmd)
bash:
	$(DOCKER_COMPOSE) exec php bash
db-shell:
	$(DOCKER_COMPOSE) exec postgres psql -U ${DB_USER} -d ${DB_NAME}
redis-cli:
	$(DOCKER_COMPOSE) exec redis redis-cli
status:
	$(DOCKER_COMPOSE) ps
