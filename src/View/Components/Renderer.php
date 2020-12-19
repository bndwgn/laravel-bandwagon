<?php

namespace Bndwgn\Bandwagon\View\Components;

use Bndwgn\Bandwagon\Bandwagon;
use Illuminate\View\Component;

class Renderer extends Component
{
    public $classSnackbar = 'bandwagon-snackbar';

    public $classMessage = 'bandwagon-message';

    public $classTitle = 'bandwagon-text bandwagon-title';

    public $classSubtitle = 'bandwagon-text bandwagon-subtitle';

    public $classTime = 'bandwagon-text bandwagon-time';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        String $classSnackbar = 'bandwagon-snackbar',
        String $classMessage = 'bandwagon-message',
        String $classTitle = 'bandwagon-text bandwagon-title',
        String $classSubtitle = 'bandwagon-text bandwagon-subtitle',
        String $classTime = 'bandwagon-text bandwagon-time'
    ) {
        $this->classSnackbar = $classSnackbar;
        $this->classMessage = $classMessage;
        $this->classTitle = $classTitle;
        $this->classSubtitle = $classSubtitle;
        $this->classTime = $classTime;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('vendor.bandwagon.renderer', [
            'bandwagonScriptVariables' => Bandwagon::scriptVariables(),
        ]);
    }
}
