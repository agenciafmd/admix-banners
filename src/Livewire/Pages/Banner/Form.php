<?php

namespace Agenciafmd\Banners\Livewire\Pages\Banner;

use Agenciafmd\Banners\Models\Banner;
use Livewire\Attributes\Validate;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public Banner $banner;

    #[Validate]
    public bool $is_active = true;

    #[Validate]
    public bool $star = false;

    #[Validate]
    public string $name = '';

    #[Validate]
    public ?string $target = null;

    #[Validate]
    public ?string $description = null;

    #[Validate]
    public ?string $link = null;

    #[Validate]
    public ?string $published_at = null;

    #[Validate]
    public ?string $until_then = null;

    public function setModel(Banner $banner): void
    {
        $this->banner = $banner;
        if ($banner->exists) {
            $this->is_active = $banner->is_active;
            $this->name = $banner->name;
            $this->target = $banner->target;
            $this->description = $banner->description;
            $this->link = $banner->link;
            $this->published_at = $banner->published_at?->format('Y-m-d\TH:i');
            $this->until_then = $banner->until_then?->format('Y-m-d\TH:i');
        }
    }

    public function rules(): array
    {
        return [
            'is_active' => [
                'required',
                'boolean',
            ],
            'star' => [
                'required',
                'boolean',
            ],
            'name' => [
                'required',
                'max:255',
            ],
            'description' => [
                'nullable',
            ],
            'link' => [
                'nullable',
                'url',
            ],
            'target' => [
                'required',
                'nullable',
            ],
            'published_at' => [
                'required',
                'date_format:Y-m-d\TH:i',
            ],
            'until_then' => [
                'nullable',
                'date_format:Y-m-d\TH:i',
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'is_active' => __('admix-banners::fields.is_active'),
            'star' => __('admix-banners::fields.star'),
            'name' => __('admix-banners::fields.name'),
            'target' => __('admix-banners::fields.target'),
            'description' => __('admix-banners::fields.description'),
            'link' => __('admix-banners::fields.link'),
            'published_at' => __('admix-banners::fields.published_at'),
            'until_then' => __('admix-banners::fields.until_then'),
        ];
    }

    public function save(): bool
    {
        $this->validate(rules: $this->rules(), attributes: $this->validationAttributes());
        $this->banner->fill($this->except('banner'));

        return $this->banner->save();
    }
}
