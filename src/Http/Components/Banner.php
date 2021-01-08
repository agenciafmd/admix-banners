<?php

namespace Agenciafmd\Banners\Http\Components;

use Agenciafmd\Banners\Models\Banner as BannerModel;
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
        string $template = 'agenciafmd/banners::components.home'
    )
    {
        $this->quantity = $quantity;
        $this->location = $location;
        $this->random = $random;
        $this->template = $template;
    }

    public function render()
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
            $collections = config("upload-configs.banner.{$this->location}");
            foreach ($collections as $collectionKey => $collection) {
                $source = $collection['sources'][0];
                $conversion = $source['conversion'];
                $media = $banner->getFirstMedia($collectionKey);
                $conversions[$source['media']] = [
                    'conversion' => $media->getUrl($conversion),
                    'conversion2x' => str_replace('%40', '@', $media->getUrl($conversion . '@2x')),
                    'conversionWebp' => $media->getUrl($conversion . '-webp'),
                    'conversionWebp2x' => str_replace('%40', '@', $media->getUrl($conversion . '-webp@2x')),
                ];
            }

            return [
                'name' => $banner->name,
                'description' => $banner->description,
                'meta' => $banner->meta,
                'link' => $banner->link,
                'target' => $banner->target,
                'conversions' => $conversions,
            ];
        });

        return view($this->template, $view);
    }
}