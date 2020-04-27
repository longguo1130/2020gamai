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
        'key' => env('SES_KEY'),
        'secret' => env('SES_KEY_SECRET'),
        'region' => env('SES_REGION'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'google' => [
        'client_id' => '427109905679-kqja0l1rg1m0llcbnnk0jlst5h5cacsl.apps.googleusercontent.com',
        'client_secret' => 'o1WUboBJbWwzUDORb9nPs2js',
        'redirect' => env('APP_URL').'/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '515262725822676',
        'client_secret' => 'ac8faed9f39e163f7e27c8a48f8f1170',
        'redirect' => env('APP_URL').'/auth/facebook/callback',
    ],

    'sign_in_with_apple' => [
        'client_id' => 'com.gamai.testid',
        'client_secret' => 'eyJraWQiOiI0NlFXWEFEN0tEIiwiYWxnIjoiRVMyNTYifQ.eyJpc3MiOiI4N1BDOTJISlA3IiwiaWF0IjoxNTg3MDk1MjgyLCJleHAiOjE2MDI2NDcyODIsImF1ZCI6Imh0dHBzOi8vYXBwbGVpZC5hcHBsZS5jb20iLCJzdWIiOiJjb20uZ2FtYWkudGVzdGlkIn0.KSbXa55yWkyaJk6C6xVXVpD5VmnWmwTwv_uMdCOdvOzPfeXY5p-lmkISta3zH78QVGOdwZZeMbsgEixlzYlKvA',
        'redirect' => env('APP_URL').'/auth/sign-in-with-apple/callback',
    ],

];
