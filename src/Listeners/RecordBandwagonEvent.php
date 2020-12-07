<?php

namespace Bndwgn\Bandwagon\Listeners;

use Bndwgn\Bandwagon\Events\BandwagonEventCreated;
use Bndwgn\Bandwagon\Models\BandwagonEvent;

class RecordBandwagonEvent
{
    public function handle(BandwagonEventCreated $event)
    {
        BandwagonEvent::create([
            'title'     => $event->title,
            'subtitle'  => $event->subtitle,
            'ip'        => $event->ip,
            'event_at'  => time(),
        ]);
    }
}