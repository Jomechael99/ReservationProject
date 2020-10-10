<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
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

    /*'google' => [
        'client_id' => '754748345647-aegag7ssoiq04hcevdfirt6c9ib1vm2h.apps.googleusercontent.com',
        'client_secret' => '8l5Ul5Cfe7uV-CHA-1DyQ7bl',
        'redirect' => 'http://reservationproject.com/auth/google/callback',
    ],*/

    'google' => [
        'client_id' => '754748345647-l6cs7lui6377pcodu4a55h1dojn43euh.apps.googleusercontent.com',
        'client_secret' => 'MaPcdHPHlzrkhK-V2pCJFC0K',
        'redirect' => 'http://web-reservation001.herokuapp.com/auth/google/callback',
    ],

];
