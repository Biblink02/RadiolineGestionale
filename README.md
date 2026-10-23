# RadiolineGestionale

Gestionale per clienti, radio, noleggi e PDF, con sito in sei lingue.
Laravel + Filament, Vue + Inertia, MariaDB. **Caddy** serve i file statici direttamente e passa le richieste dell'app a PHP-FPM. Bun compila il frontend.

## Locale

Serve Docker Compose. Configurazione Docker in `.env.LOCAL`, configurazione Laravel in `src/.env`: per una nuova installazione copiali dai rispettivi `.env.example`, allinea le credenziali e usa `DB_HOST=database`. Se esistono già, conservali, inclusa `APP_KEY`.

Preparazione iniziale, dalla radice del progetto:

```sh
dc() { docker compose --env-file .env.LOCAL -f docker-compose.local.yml "$@"; }
dc build app
dc run --rm --no-deps app composer install
dc run --rm --no-deps app php artisan storage:link
```

Solo su una nuova installazione, genera la chiave se vuota:

```sh
dc run --rm --no-deps app php artisan key:generate
```

Da quel momento basta:

```sh
./run.local.sh
```

Sito: http://localhost:8100 — Gestionale: http://localhost:8100/admin. Vite e scheduler partono insieme all'app. In locale, l'avvio applica le migrazioni mancanti e il seed: crea gli utenti di sviluppo e le radio 1000–9999 mancanti, conservando i dati già presenti.

## Produzione

Se `.env` non esiste, copialo da `.env.PROD`. Configura `.env` e `src/.env`: `CADDY_SITE=tuo-dominio.it`, `APP_URL=https://tuo-dominio.it`, `APP_ENV=production`, `APP_DEBUG=false`. Con DNS corretto e porte 80/443 disponibili, Caddy gestisce HTTPS automaticamente. Mantieni chiave e database esistenti.

MariaDB è inclusa, con volume persistente `database`: usa `DB_HOST=database` e credenziali coerenti nei due file. Il servizio `frontend` viene eseguito solo per compilare gli asset e poi termina; non parte con l'avvio normale.

```sh
dp() { docker compose "$@"; }
dp build app
dp run --rm --no-deps app composer install --no-dev --optimize-autoloader
dp run --rm --no-deps frontend
rm -f src/public/hot
dp run --rm --no-deps app php artisan storage:link
dp run --rm --no-deps app php artisan optimize
sh run.sh
```

## Test

Con le dipendenze di sviluppo installate e la funzione `dc` definita sopra:

```sh
dc run --rm --no-deps app php artisan test
sh docker/test-static.sh
```

I test PHP usano SQLite in memoria, senza toccare il database dell'app.
