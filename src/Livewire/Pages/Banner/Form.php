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
    public string $location = '';

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
    public array $video_files = [];

    #[Validate]
    public array $video_meta = [];

    #[Validate]
    public Collection $desktop;

    #[Validate]
    public Collection $notebook;

    #[Validate]
    public Collection $mobile;

    #[Validate]
    public Collection $video;

    public function setModel(Banner $banner, string $location): void
    {
        $this->banner = $banner;
        $this->desktop = collect();
        $this->notebook = collect();
        $this->mobile = collect();
        $this->video = collect();
        ($banner->exists) ?: $this->location = $location;
        if ($banner->exists) {
            $this->is_active = $banner->is_active;
            $this->star = $banner->star;
            $this->location = $banner->location;
            $this->name = $banner->name;
            $this->target = $banner->target;
            $this->link = $banner->link;
            $this->published_at = $banner->published_at?->format('Y-m-d\TH:i');
            $this->until_then = $banner->until_then?->format('Y-m-d\TH:i');
            $this->desktop = $banner->desktop;
            $this->notebook = $banner->notebook;
            $this->mobile = $banner->mobile;
            $this->video = $banner->video;
        }
    }

    public function rules(): array
    {
        $rules = [
            'is_active' => [
                'required',
                'boolean',
            ],
            'star' => [
                'required',
                'boolean',
            ],
            'location' => [
                'required',
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
                'max:' . config("admix-banners.locations.{$this->location}.files.desktop.max"),
                Rule::dimensions()
                    ->maxWidth(config("admix-banners.locations.{$this->location}.files.desktop.max_width"))
                    ->maxHeight(config("admix-banners.locations.{$this->location}.files.desktop.max_height")),
            ],
            'desktop' => [
                'array',
                'required',
                'min:1',
            ],
            'notebook_files.*' => [
                'image',
                'max:' . config("admix-banners.locations.{$this->location}.files.notebook.max"),
                Rule::dimensions()
                    ->maxWidth(config("admix-banners.locations.{$this->location}.files.notebook.max_width"))
                    ->maxHeight(config("admix-banners.locations.{$this->location}.files.notebook.max_height")),
            ],
            'notebook' => [
                'array',
                'required',
                'min:1',
            ],
            'mobile_files.*' => [
                'image',
                'max:' . config("admix-banners.locations.{$this->location}.files.mobile.max"),
                Rule::dimensions()
                    ->maxWidth(config("admix-banners.locations.{$this->location}.files.mobile.max_width"))
                    ->maxHeight(config("admix-banners.locations.{$this->location}.files.mobile.max_height")),
            ],
            'mobile' => [
                'array',
                'required',
                'min:1',
            ],
        ];

        if (config("admix-banners.locations.{$this->location}.files.video.show")) {
            $rules['video_files.*'] = [
                'mimes:mp4',
                'mimetypes:video/mp4',
                'max:' . config("admix-banners.locations.{$this->location}.files.video.max"),
            ];
            $rules['video'] = [
                'array',
                'nullable',
            ];
            $rules['video_meta'] = [
                'array',
            ];
        }


        return $rules;
    }

    public function validationAttributes(): array
    {
        return [
            'is_active' => __('admix-banners::fields.is_active'),
            'star' => __('admix-banners::fields.star'),
            'name' => __('admix-banners::fields.name'),
            'location' => __('admix-banners::fields.location'),
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
            'video' => __('admix-banners::fields.video'),
            'video_files.*' => __('admix-banners::fields.video_files'),
        ];
    }

    public function save(): bool
    {
        $this->validate(rules: $this->rules(), attributes: $this->validationAttributes());
        $this->banner->fill($this->except([
            'banner',
            'desktop',
            'notebook',
            'mobile',
            'video',
            'desktop_files',
            'notebook_files',
            'mobile_files',
            'video_files',
            'desktop_meta',
            'notebook_meta',
            'mobile_meta',
            'video_meta',
        ]));

        if (!$this->banner->exists) {
            $this->banner->save();
        }

        $this->syncMedias($this->banner, [
            'desktop',
            'notebook',
            'mobile',
        ]);

        if (config("admix-banners.locations.{$this->location}.files.video.show")) {
            $this->syncMedia($this->banner, 'video');
        }

        return $this->banner->save();
    }
}
