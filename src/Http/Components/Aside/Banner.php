<?php

namespace Agenciafmd\Banners\Http\Components\Aside;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{
    public function __construct(
        public string $icon = '',
        public string $label = '',
        public string $url = '',
        public bool   $active = false,
        public bool   $visible = false,
    )
    {
    }

    public function render(): View
    {
        $this->icon = __(config('admix-banners.icon'));
        $this->label = __(config('admix-banners.name'));
        $this->url = route('admix.banners.index');
        $this->active = request()?->currentRouteNameStartsWith('admix.banners');
        $this->visible = true;

        return view('admix::components.aside.item');
    }
}
