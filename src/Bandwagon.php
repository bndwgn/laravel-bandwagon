<?php

namespace Bndwgn\Bandwagon;

use Bndwgn\Bandwagon\Events\BandwagonEventCreated;

class Bandwagon
{
    /**
     * The main core functionality for creating events that will
     * eventually get displayed to the user
     *
     * @param String $title
     * @param String $subtitle
     * @param String $ip
     * @param String $url
     * @return void
     */
    public static function createEvent(
        String $title,
        String $subtitle,
        String $ip = '',
        String $url = ''
    ) {
        if (! config('bandwagon.enabled')) {
            return;
        }
        
        event(new BandwagonEventCreated($title, $subtitle, $ip, $url));
    }

    /**
     * Get the default JavaScript variables for Bandwagon.
     *
     * @return array
     */
    public static function scriptVariables()
    {
        return [
            'delay' => config('bandwagon.delay'),
            'display' => config('bandwagon.display'),
            'enabled' => config('bandwagon.enabled'),
            'poll' => config('bandwagon.poll'),
            'path' => config('bandwagon.path'),
        ];
    }
}
