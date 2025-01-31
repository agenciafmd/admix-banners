<?php

namespace Agenciafmd\Banners\Livewire\Pages\Banner;

use Agenciafmd\Banners\Models\Banner;
use Agenciafmd\Ui\Traits\WithMediaSync;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    use WithMediaSync;

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
    public ?string $link = null;

    #[Validate]
    public ?string $published_at = null;

    #[Validate]
    public ?string $until_then = null;

    #[Validate]
    public array $desktop_files = [];

    #[Validate]
    public array $desktop_meta = [];

    #[Validate]
    public Collection $desktop;

    public function setModel(Banner $banner): void
    {
        $this->banner = $banner;
        $this->desktop = collect();
        $this->desktop_meta = [];
        if ($banner->exists) {
            $this->is_active = $banner->is_active;
            $this->name = $banner->name;
            $this->target = $banner->target;
            $this->link = $banner->link;
            $this->published_at = $banner->published_at?->format('Y-m-d\TH:i');
            $this->until_then = $banner->until_then?->format('Y-m-d\TH:i');
            $this->desktop = $banner->desktop;
            $this->desktop_meta = $this->desktop->pluck('meta')
                ->toArray();
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
            'desktop_files.*' => [
                'image',
                'max:1024',
                Rule::dimensions()
                    ->maxWidth(1200)
                    ->maxHeight(1200),
            ],
            'desktop' => [
                'array',
                'required',
                'min:1',
            ],
            'desktop_meta' => [
                'array',
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
            'link' => __('admix-banners::fields.link'),
            'published_at' => __('admix-banners::fields.published_at'),
            'until_then' => __('admix-banners::fields.until_then'),
            'desktop' => __('admix-banners::fields.desktop'),
            'desktop_files.*' => __('admix-banners::fields.desktop_files'),
        ];
    }

    public function save(): bool
    {
        $this->validate(rules: $this->rules(), attributes: $this->validationAttributes());
        $this->banner->fill($this->except(['banner']));

        if (!$this->banner->exists) {
            $this->banner->save();
        }

        $this->syncMedia($this->banner, 'desktop');

        return $this->banner->save();
    }
}
