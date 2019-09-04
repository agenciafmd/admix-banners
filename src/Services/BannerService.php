<?php

namespace Agenciafmd\Banners\Services;

use Agenciafmd\Banners\Banner;

class BannerService
{
    public function places()
    {
        $array = [];
        $places = config('admix-banners.places');
        foreach ($places as $slug => $place) {
            $firstElement = collect($place['items'])->first();

            $array[$slug] = "{$place['name']} ({$firstElement['width']}x{$firstElement['height']})";
        }

        return collect($array);
    }
}
