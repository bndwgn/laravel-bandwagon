<?php

namespace Bndwgn\Bandwagon\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BandwagonEventCreated
{
    use Dispatchable;
    use SerializesModels;

    /**
     * The title for the message displayed to users 
     */
    public $title;

    /**
     * The subtitle for the message displayed to users 
     */
    public $subtitle;

    /**
     * The ip address of the user who generated the event,
     * this is nullable and should only be used if you want
     * to filter this event from being seen by the initiator
     * of this event. 
     */
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
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->ip = $ip;
    }
}
