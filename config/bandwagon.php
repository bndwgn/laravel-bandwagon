<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Poll timing
    |--------------------------------------------------------------------------
    |
    | This is how often bandwagon will poll for new events (in seconds). If an 
    | event occurs this is the maximum amount of time it might take for it
    | to appear on other user's screens. You can change this to any number you 
    | would like and it will be passed to the vue component which makes the api 
    | calls.
    */
    'poll' => env('BANDWAGON_POLL', 30),

    /*
    |--------------------------------------------------------------------------
    | Display timing
    |--------------------------------------------------------------------------
    |
    | This is how long the message will appear on the user's screen. This will
    | be passed to the blade component which dictates how long it appears for.
    */
    'display' => env('BANDWAGON_DISPLAY', 5),

    /*
    |--------------------------------------------------------------------------
    | Oldest message to display
    |--------------------------------------------------------------------------
    |
    | This is how long the message will appear on the user's screen. This will
    | be passed to the blade component which dictates how long it appears for.
    */
    'oldest' => env('BANDWAGON_OLDEST', 86400),

    /*
    |--------------------------------------------------------------------------
    | Master switch
    |--------------------------------------------------------------------------
    |
    | This will determine whether Bandwagon will display anything to users.
    */
    'enabled' => env('BANDWAGON_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Cleanup
    |--------------------------------------------------------------------------
    |
    | These keys are for use with cleaning up old Bandwagon Events. Events are
    | stored in the database and will continue to grow with time, depending on
    | your needs you may want to clear ones that will not be part of a query. 
    | Any events that are older than the `oldest` config setting will never be 
    | used or displayed to a user. It is recommended that you keep your 
    | `olderthan` config the same or larger than the `oldest` key.
    */
    'cleanup' => [
        'enabled' => env('BANDWAGON_CLEANUP_ENABLED', true),
        'olderthan' => env('BANDWAGON_CLEANUP_OLDER_THAN', 86400),
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    | These two values are for the api endpoint that exposes bandwagon
    | events to the client.
    */
    'domain' => env('BANDWAGON_DOMAIN', null),
    'path' => env('BANDWAGON_PATH', 'bandwagon'),
];
