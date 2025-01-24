<?php

namespace Agenciafmd\Banners\Database\Factories;

use Agenciafmd\Banners\Models\Banner;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
{
    protected $model = Banner::class;

    public function definition(): array
    {
        return [
            'is_active' => $this->faker->optional(0.3, 1)
                ->randomElement([0]),
            'star' => 0,
            'location' => key(config('admix-banners.locations')),
            'name' => ucfirst($this->faker->sentence()),
            'description' => null,
            'link' => $this->faker->url,
            'target' => '_blank',
            'published_at' => now()->format('Y-m-d\TH:i'),
            'until_then' => null,
            'meta' => [],
        ];
    }
}