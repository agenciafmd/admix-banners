<?php

namespace Agenciafmd\Banners\Livewire\Pages\Banner;

use Agenciafmd\Admix\Livewire\Pages\Base\Index as BaseIndex;
use Agenciafmd\Banners\Models\Banner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;

class Index extends BaseIndex
{
    protected $model = Banner::class;

    protected string $indexRoute = 'admix.banners.index';

    protected string $trashRoute = 'admix.banners.trash';

    protected string $creteRoute = 'admix.banners.create';

    protected string $editRoute = 'admix.banners.edit';

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
}
