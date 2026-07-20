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

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI', env('APP_URL').'/auth/google/callback'),
    ],

    'razorpay' => [
        'key' => env('RAZORPAY_KEY', "rzp_live_SvS1LCNQE1pJj6"),
        'secret' => env('RAZORPAY_SECRET', "8e56gW8Olp10TNigNljeBWNJ" ),
        // Optional fallback if WEBHOOK_SECRET is empty in RazorpayService
        'webhook_secret' => env('RAZORPAY_WEBHOOK_SECRET', 'cH8taN@Hs4L2UDH'),
        // live = Razorpay Checkout | simulated = local test without API
        'payment_mode' => env('BOOK_PAYMENT_MODE', 'test'),
    ],

];
