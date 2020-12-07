<?php

namespace Bndwgn\Bandwagon;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bndwgn\Bandwagon\Bandwagon
 */
class BandwagonFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bandwagon';
    }
}
