<?php

namespace Agenciafmd\Banners\Services;

class BannerService
{
    public function locations()
    {
        $array = [];
        $locations = config('admix-banners.locations');
        foreach ($locations as $slug => $location) {
            $firstElement = collect($location['items'])->first();

            $array[$slug] = "{$location['name']} ({$firstElement['width']}x{$firstElement['height']})";
        }

        return collect($array);
    }
}
