<?php

return [
    // Caddy talks FastCGI directly; only explicitly configured HTTP proxies are trusted.
    'proxies' => env('APP_TRUST_PROXY'),
];
