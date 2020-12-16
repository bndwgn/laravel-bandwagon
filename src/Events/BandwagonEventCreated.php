<?php

namespace Bndwgn\Bandwagon\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BandwagonEventCreated
{
    use Dispatchable;
    use SerializesModels;

    public $title;
    public $subtitle;
    public $ip;

    /**
     * Create a new event instance.
     *
     * @param String $title
     * @param String $subtitle
     * @param String $ip
     * @return void
     */
    public function __construct(String $title, String $subtitle, String $ip = '')
    {
        error_log('event_fired');
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->ip = $ip;
    }
}
