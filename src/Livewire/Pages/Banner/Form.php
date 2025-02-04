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
    public array $notebook_files = [];

    #[Validate]
    public array $notebook_meta = [];

    #[Validate]
    public array $mobile_files = [];

    #[Validate]
    public array $mobile_meta = [];

    #[Validate]
    public Collection $desktop;

    #[Validate]
    public Collection $notebook;

    #[Validate]
    public Collection $mobile;

    public function setModel(Banner $banner): void
    {
        $this->banner = $banner;
        $this->desktop = collect();
        $this->notebook = collect();
        $this->mobile = collect();
        if ($banner->exists) {
            $this->is_active = $banner->is_active;
            $this->name = $banner->name;
            $this->target = $banner->target;
            $this->link = $banner->link;
            $this->published_at = $banner->published_at?->format('Y-m-d\TH:i');
            $this->until_then = $banner->until_then?->format('Y-m-d\TH:i');
            $this->desktop = $banner->desktop;
            $this->notebook = $banner->notebook;
            $this->mobile = $banner->mobile;
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
                'max:4096',
                Rule::dimensions()
                    ->maxWidth(3600)
                    ->maxHeight(1700),
            ],
            'desktop' => [
                'array',
                'required',
                'min:1',
            ],
            'notebook_files.*' => [
                'image',
                'max:2048',
                Rule::dimensions()
                    ->maxWidth(2160)
                    ->maxHeight(1660),
            ],
            'notebook' => [
                'array',
                'required',
                'min:1',
            ],
            'mobile_files.*' => [
                'image',
                'max:2048',
                Rule::dimensions()
                    ->maxWidth(1360)
                    ->maxHeight(2380),
            ],
            'mobile' => [
                'array',
                'required',
                'min:1',
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
            'notebook' => __('admix-banners::fields.notebook'),
            'notebook_files.*' => __('admix-banners::fields.notebook_files'),
            'mobile' => __('admix-banners::fields.mobile'),
            'mobile_files.*' => __('admix-banners::fields.mobile_files'),
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
        $this->syncMedia($this->banner, 'notebook');
        $this->syncMedia($this->banner, 'mobile');

        return $this->banner->save();
    }
}
