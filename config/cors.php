<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | Allow CORS for Laravel. This should be compatible with most Laravel applications.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout', 'password/confirm', 'password/email', 'password/reset', 'register', 'password/verification', 'password/verification/resend'],

    /*
    |--------------------------------------------------------------------------
    | A list of the request methods that will be allowed.
    |--------------------------------------------------------------------------
    */
    'allowed_methods' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | A list of the request headers that will be allowed.
    |--------------------------------------------------------------------------
    */
    'allowed_headers' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | A list of the response headers that are added to the whitelist.
    |--------------------------------------------------------------------------
    */
    'exposed_headers' => [],

    /*
    |--------------------------------------------------------------------------
    | A timestamp in seconds before the preflight request expires.
    |--------------------------------------------------------------------------
    */
    'max_age' => 0,

    /*
    |--------------------------------------------------------------------------
    | Whether or not the browser should send credentials.
    |--------------------------------------------------------------------------
    */
    'supports_credentials' => false,
];

