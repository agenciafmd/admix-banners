<?php

namespace Agenciafmd\Banners\Services;

class BannerService
{
    public function locations()
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
