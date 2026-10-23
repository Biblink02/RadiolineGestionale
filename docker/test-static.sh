#!/bin/sh
set -eu
cd "$(dirname "$0")/.."

test_root=$(mktemp -d)
container_id=
trap 'if [ -n "$container_id" ]; then docker rm -f "$container_id" >/dev/null; fi; rm -rf "$test_root"' EXIT HUP INT TERM
mkdir -p "$test_root/build/assets" "$test_root/storage"
printf 'static works' > "$test_root/robots.txt"
printf 'console.log("asset")' > "$test_root/build/assets/app-test.js"
printf 'secret' > "$test_root/.env"
printf '<?php echo "must not be served";' > "$test_root/storage/upload.php"
printf '<?php echo "must not be served";' > "$test_root/index.php"

# No PHP container: static responses prove that Laravel was never invoked.
container_id=$(docker run -d --rm -p 127.0.0.1::80 \
    -e CADDY_SITE=:80 \
    -v "$PWD/config/Caddyfile:/etc/caddy/Caddyfile:ro" \
    -v "$test_root:/var/www/app/public:ro" caddy:2.11.4-alpine)
address="http://$(docker port "$container_id" 80/tcp)"
attempt=0
until curl -fsS "$address/robots.txt" > "$test_root/response" 2>/dev/null; do
    attempt=$((attempt + 1))
    [ "$attempt" -lt 20 ] || exit 1
    sleep 0.2
done
[ "$(cat "$test_root/response")" = 'static works' ]
curl -fsSI "$address/build/assets/app-test.js" | tr -d '\r' | grep -qi '^Cache-Control: public, max-age=31536000, immutable$'
for path in /build/missing.js /images/missing.jpg /.env /storage/upload.php; do
    [ "$(curl -sS -o /dev/null -w '%{http_code}' "$address$path")" = 404 ]
done
if curl -sSI "$address/build/assets/missing.js" | grep -qi 'immutable'; then
    exit 1
fi
[ "$(curl -sS -o /dev/null -w '%{http_code}' "$address/en")" = 502 ]
printf 'Static files, cache headers, missing assets and PHP isolation: OK\n'
