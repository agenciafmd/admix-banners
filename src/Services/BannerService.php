<?php

namespace Agenciafmd\Banners\Services;

class BannerService
{
    public function locations(): string|array
    {
        $array = [];
        $locations = config('admix-banners.locations');

        if (count($locations) === 1) {
            return key($locations);
        }

        foreach ($locations as $name => $location) {
            $width = $location['files']['desktop']['max_width'];
            $height = $location['files']['desktop']['max_height'];

            $array[] = [
                'value' => $name,
                'label' => ucfirst($name) . " ({$width}x{$height})",
            ];
        }

        return collect($array)
            ->prepend([
                'value' => '',
                'label' => '-',
            ])
            ->toArray();
    }
}
