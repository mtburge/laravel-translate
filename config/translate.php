<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Translation Driver
    |--------------------------------------------------------------------------
    |
    | This option controls which service you would like to use to obtain
    | translations from. You may set this to one of the options below.
    |
    | Supported: "google"
    |
    */
    'driver' => 'google',

    /*
    |--------------------------------------------------------------------------
    | Translation Service Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can define all of the services which can be used for translation
    | along with their associated settings. These settings will be passed
    | to the translation service as per their own requirements.
    |
    */
    'services' => [
        'google' => [
            'key' => env('GOOGLE_TRANSLATE_API_KEY')
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Translation methods
    |--------------------------------------------------------------------------
    |
    | Here you can define the methods which are used to provide translation
    | lookups. We'll scan the the specified directories for these methods
    | and translate their strings into the specified languages.
    |
    */
    'methods' => [
        'trans',
        '__'
    ],

    /*
    |--------------------------------------------------------------------------
    | Translation paths
    |--------------------------------------------------------------------------
    |
    | Here you can define the paths which should be scanned to search
    | for the translation methods. Sensible defaults are provided.
    |
    */
    'paths' => [
        app_path(),
        resource_path()
    ]
];
