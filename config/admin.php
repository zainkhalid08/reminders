<?php

// use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Slug That Is Used To Access Admin Panel
    |--------------------------------------------------------------------------
    |
    | This option controls the default slug that is
    | used as a prefix for all admin routes.
    |
    */

    'slug' => 'maker',

    /*
    |--------------------------------------------------------------------------
    | Credentials Of The Admin
    |--------------------------------------------------------------------------
    |
    | This option controls the default slug that is
    | used as a prefix for all admin routes.
    |
    */

    'name' => env('ADMIN_NAME'),
    'email' => env('ADMIN_EMAIL'),
    'password' => env('ADMIN_PASSWORD'),

];
