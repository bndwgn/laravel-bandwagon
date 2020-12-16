<?php

namespace Bndwgn\Bandwagon\Http\Controllers;

use Bndwgn\Bandwagon\Models\BandwagonEvent;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        $oldest = time() - config('bandwagon.cleanup.olderthan');

        return BandwagonEvent::where('event_at', '>', $request->query('since', $oldest))
            ->where('ip', '!=', $request->ip())
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
