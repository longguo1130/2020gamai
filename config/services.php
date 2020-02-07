<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'google' => [
        'client_id' => '18729931769-8417ceu4ltdrel6c7ci2re5f4qj22but.apps.googleusercontent.com',
        'client_secret' => 'ZkILqCa1zmO2S099KDynvzuc',
        'redirect' => env('APP_URL').'/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '2822777287784007',
        'client_secret' => 'b494a29ca17ef16e5f58437fa5e310f2',
        'redirect' => env('APP_URL').'/auth/facebook/callback',
    ],
];
