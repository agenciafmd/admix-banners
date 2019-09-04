<?php

namespace Agenciafmd\Banners\ViewComponents;

use Agenciafmd\Banners\Banner;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\View;

class BannerComponent implements Htmlable
{
    protected $qty;

    protected $location;

    protected $rand;

    protected $template;

    public function __construct($qty = 4, $location = null, $rand = false, $template = 'agenciafmd/banners::frontend.default')
    {
        $this->qty = $qty;
        $this->location = $location;
        $this->rand = $rand;
        $this->template = $template;
    }

    public function toHtml()
    {
        $this->location = ($this->location === null) ? key(config('admix-banners.locations')) : $this->location;

        $query = Banner::where('location', $this->location)
            ->isActive();

        if ($this->rand === true) {
            $query->inRandomOrder();
        } else {
            $query->sort();
        }

        $view['banners'] = $query->take($this->qty)
            ->get();

        return View::make($this->template)
            ->with($view)
            ->render();
    }
}
