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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'firebase' => [
        'apiKey' => "AIzaSyD8Y_XS1rIobvwT1yimbB5RmVtaTKNchjQ",
        'authDomain' => "astha-jyotish-e79cc.firebaseapp.com",
        'databaseURL' => "https://astroguru-75d26-default-rtdb.firebaseio.com",
        'projectId' => "astha-jyotish-e79cc",
        'storageBucket' => "astha-jyotish-e79cc.appspot.com",
        'messagingSenderId' => "736238700309",
        'appId' => "1:736238700309:web:e534252db116a6b373cb1c",
        'measurementId' => "G-4MVQX2R6C0",
    ],
];
