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
            'name' => $this->faker->sentence(3),
        ];
    }
}
