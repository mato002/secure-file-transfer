<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This controls the default authentication "guard" and "passwords" settings.
    | You can change these if needed to another guard or password reset config.
    |
    */

    'defaults' => [
        'guard' => 'web', // Default guard for regular users
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Guards define how users are authenticated for each session.
    | Each guard uses a user provider to get user data.
    |
    | Supported driver: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'regular_user' => [
            'driver' => 'session',
            'provider' => 'regular_users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins', // Admin provider
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Providers define how user information is retrieved from storage.
    | Each guard must have a provider. You can have multiple providers.
    |
    | Supported driver: "eloquent" (recommended), "database"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Regular user model
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class, //  Corrected:  Use Admin model.  Crucial!
        ],

        'regular_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\RegularUser::class, // Separate model for regular users if needed
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Reset Settings
    |--------------------------------------------------------------------------
    |
    | You can set password reset configurations for each type of user.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60, // Minutes the token is valid
            'throttle' => 60, // Prevent too many resets at once
        ],

        'regular_users' => [
            'provider' => 'regular_users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Time (in seconds) before a password confirmation times out.
    | Default is 3 hours (10800 seconds).
    |
    */

    'password_timeout' => 10800,
];
