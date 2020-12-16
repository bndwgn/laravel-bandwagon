<?php

namespace Bndwgn\Bandwagon\Commands;

use Bndwgn\Bandwagon\Models\BandwagonEvent;
use Illuminate\Console\Command;

class BandwagonCleanup extends Command
{
    public $signature = 'bandwagon:cleanup';

    public $description = 'Cleanup old bandwagon events';

    public function handle()
    {
        $this->comment('Removing old Bandwagon events...');

        $time = time() - config('bandwagon.cleanup.olderthan');
        BandwagonEvent::where('event_at', '<', $time)->delete();

        $this->comment('All done');
    }
}
