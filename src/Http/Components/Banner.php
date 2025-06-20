<?php

namespace Agenciafmd\Banners\Http\Components;

use Agenciafmd\Banners\Models\Banner as BannerModel;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{
    public int $quantity;

    public string $location;

    public bool $random;

    public string $template;

    public function __construct(
        int $quantity = 4,
        string $location = 'home',
        bool $random = false,
        string $template = 'admix-banners::components.home'
    ) {
        $this->quantity = $quantity;
        $this->location = $location;
        $this->random = $random;
        $this->template = $template;
    }

    public function render(): View
    {
        $query = BannerModel::query()
            ->where('location', $this->location)
            ->isActive();

        if ($this->random === true) {
            $query->inRandomOrder();
        } else {
            $query->sort();
        }

        $banners = $query->take($this->quantity)
            ->get();

        $view['banners'] = $banners->map(function ($banner) {
            $files = config("admix-banners.locations.{$this->location}.files");
            foreach ($files as $fileKey => $file) {
                $collection = $fileKey;
                $media = $banner->getFirstMedia($collection);
                $responsiveImages[$file['media']] = $media;
            }

            return [
                'name' => $banner->name,
                'meta' => $banner->meta,
                'link' => $banner->link,
                'target' => $banner->target,
                'images' => $responsiveImages,
            ];
        });

        return view($this->template, $view);
    }
}
