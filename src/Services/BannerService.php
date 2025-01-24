<?php

namespace Agenciafmd\Banners\Services;

use Illuminate\Support\Collection;

class BannerService
{
    public function locations(): Collection
    {
        $array = [];
        $locations = config('upload-configs.banner');
        foreach ($locations as $name => $location) {
            $width = $location['desktop']['sources'][0]['width'];
            $height = $location['desktop']['sources'][0]['height'];

            $array[$name] = ucfirst($name) . " ({$width}x{$height})";
        }

        return collect($array);
    }
}
