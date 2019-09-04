<?php

namespace Agenciafmd\Banners\ViewComponents;

use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Support\Htmlable;
use Agenciafmd\Banners\Banner;

class BannerComponent implements Htmlable
{
    protected $qty;

    protected $place;

    protected $rand;

    protected $template;

    public function __construct($qty = 4, $place = null, $rand = false, $template = 'agenciafmd/banners::frontend.default')
    {
        $this->qty = $qty;
        $this->place = $place;
        $this->rand = $rand;
        $this->template = $template;
    }

    public function toHtml()
    {
        // TODO: cache / troca place por location

        $this->place = ($this->place === null) ? key(config('admix-banners.places')) : $this->place;

        $query = Banner::where('place', $this->place)
            ->isActive();

        if ($this->rand === true) {
            $query->inRandomOrder();
        } else {
            $query->sort();
        }

        $view['banners'] = $query->take($this->qty)
            ->get();
        $view['slug'] = $this->place;

        return View::make($this->template)
            ->with($view)
            ->render();
    }
}
