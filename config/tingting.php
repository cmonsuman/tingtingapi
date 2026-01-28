<?php

return [
    /*
    |--------------------------------------------------------------------------
    | TingTing API Base URL
    |--------------------------------------------------------------------------
    |
    | This is the base URL for the TingTing API.
    |
    */
    'base_url' => env('TINGTING_BASE_URL', 'https://app.tingting.io/api/v1/'),

    /*
    |--------------------------------------------------------------------------
    | TingTing API Token
    |--------------------------------------------------------------------------
    |
    | This is the static API token provided by TingTing for authentication.
    | It can be used as an alternative to JWT login.
    |
    */
    'api_token' => env('TINGTING_API_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | TingTing Credentials
    |--------------------------------------------------------------------------
    |
    | Default credentials for obtaining Bearer tokens if needed.
    |
    */
    'email' => env('TINGTING_EMAIL'),
    'password' => env('TINGTING_PASSWORD'),
];
