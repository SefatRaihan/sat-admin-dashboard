<?php

return [
    'mode'        => env('TAP_MODE', 'test'),
    'secret_key'  => env('TAP_SECRET_KEY'),
    'public_key'  => env('TAP_PUBLIC_KEY'),
    'currency'    => env('TAP_CURRENCY', 'KWD'),
    'base_url'    => 'https://api.tap.company/v2',
    // where Tap redirects the shopper after payment
    'callback'    => env('APP_URL').'/tap/callback',
    // server-to-server webhooks (set this URL in Tap Dashboard)
    'webhook'     => env('APP_URL').'/tap/webhook',
];
