#!/bin/sh
set -eu
cd "$(dirname "$0")"
exec docker compose --env-file .env.LOCAL -f docker-compose.local.yml --profile dev up --build "$@"
