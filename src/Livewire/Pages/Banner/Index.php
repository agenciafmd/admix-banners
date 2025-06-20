<?php

namespace Agenciafmd\Banners\Livewire\Pages\Banner;

use Agenciafmd\Admix\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Banners\Models\Banner;
use Agenciafmd\Banners\Services\BannerService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;

class Index extends BaseIndex
{
    protected $model = Banner::class;

    protected string $indexRoute = 'admix.banners.index';

    protected string $trashRoute = 'admix.banners.trash';

    protected string $creteRoute = 'admix.banners.create';

    protected string $editRoute = 'admix.banners.edit';

    protected $listeners = [
        'bulkDelete' => 'bulkDelete',
        'bulkRestore' => 'bulkRestore',
        'createWithLocation' => 'createWithLocation',
    ];

    public function configure(): void
    {
        $this->packageName = __(config('admix-banners.name'));

        parent::configure();
    }

    public function filters(): array
    {
        $this->setAdditionalFilters([
            DateTimeFilter::make(__('admix-banners::fields.published_at'), 'published_at')
                ->filter(static function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('published_at'), '>=', Carbon::parse($value)
                        ->format(config('admix.timestamp.format')));
                }),
            DateTimeFilter::make(__('admix-banners::fields.until_then'), 'until_then')
                ->filter(static function (Builder $builder, string $value) {
                    $builder->where($builder->qualifyColumn('until_then'), '<=', Carbon::parse($value)
                        ->format(config('admix.timestamp.format')));
                }),
        ]);

        return parent::filters();
    }

    public function columns(): array
    {
        $this->setAdditionalColumns([
            Column::make(__('admix-banners::fields.published_at'), 'published_at')
                ->sortable()
                ->searchable()
                ->format(static fn ($value) => $value
                    ? $value->format(config('admix.timestamp.format'))
                    : '-'),
            Column::make(__('admix-banners::fields.until_then'), 'until_then')
                ->sortable()
                ->searchable()
                ->format(static fn ($value) => $value
                    ? $value->format(config('admix.timestamp.format'))
                    : '-'),
        ]);

        return parent::columns();
    }

    public function headerActions(): array
    {
        if ($this->indexRoute && $this->isTrash) {
            return [
                '<x-btn href="' . route($this->indexRoute) . '"
                    label="' . __('Back') . '"/>',
            ];
        }
        $actions = [];
        if ($this->creteRoute && $this->user->can('create', $this->builder()->getModel())) {
            $options = new BannerService()->locations();
            $optionsString = str_replace(['{', '}', ':', '"'], ['[', ']', '=>', '\''], json_encode($options));
            $actions[] = is_array($options) ? '<x-btn.create-with-options :options="' . $optionsString .  '"
                label="' . $this->packageName . '" />' : '<x-btn.create href="' . route($this->creteRoute, [$options]) . '"
                label="' . $this->packageName . '" />';
        }
        if ($this->trashRoute && $this->user->can('restore', $this->builder()->getModel())) {
            $actions[] = '<x-btn.trash href="' . route($this->trashRoute) . '"
                label="" />';
        }

        return $actions;
    }

    public function createWithLocation(string $location): RedirectResponse|Redirector
    {
        return redirect()->route($this->creteRoute, ['location' => $location]);
    }
}
