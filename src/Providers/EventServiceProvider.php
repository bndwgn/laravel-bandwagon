<?php

namespace Bndwgn\Bandwagon\Providers;

use Bndwgn\Bandwagon\Events\BandwagonEventCreated;
use Bndwgn\Bandwagon\Listeners\RecordBandwagonEvent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BandwagonEventCreated::class => [
            RecordBandwagonEvent::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
