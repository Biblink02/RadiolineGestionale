#!/bin/sh

docker compose -f docker-compose.local.yml down --remove-orphans
docker compose -f docker-compose.local.yml up
docker compose -f docker-compose.local.yml down