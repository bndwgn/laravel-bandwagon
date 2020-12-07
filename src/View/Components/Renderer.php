<?php

namespace Bndwgn\Bandwagon\View\Components;

use Illuminate\View\Component;

class Renderer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('vendor.bandwagon.renderer', [
            'display' => config('bandwagon.display'),
            'poll' => config('bandwagon.poll'),
            'prefix' => config('bandwagon.prefix'),
        ]);
    }
}
