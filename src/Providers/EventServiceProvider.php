<?php

namespace Bndwgn\Bandwagon\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Bndwgn\Bandwagon\Events\BandwagonEventCreated;
use Bndwgn\Bandwagon\Listeners\RecordBandwagonEvent;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BandwagonEventCreated::class => [
            RecordBandwagonEvent::class,
        ]
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