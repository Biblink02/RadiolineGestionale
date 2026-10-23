#!/bin/sh
set -eu
cd "$(dirname "$0")"
# Dependencies, assets and Laravel caches are prepared before restarting services.
exec docker compose up -d --build "$@"
