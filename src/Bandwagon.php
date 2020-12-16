<?php

namespace Bndwgn\Bandwagon;

use Bndwgn\Bandwagon\Events\BandwagonEventCreated;

class Bandwagon
{
    public static function createEvent(
        String $title,
        String $subtitle,
        String $ip = null
    ) {
        event(new BandwagonEventCreated($title, $subtitle, $ip));
    }

    /**
     * Get the default JavaScript variables for Bandwagon.
     *
     * @return array
     */
    public static function scriptVariables()
    {
        return [
            'display' => config('bandwagon.display'),
            'poll' => config('bandwagon.poll'),
            'path' => config('bandwagon.path'),
        ];
    }
}
