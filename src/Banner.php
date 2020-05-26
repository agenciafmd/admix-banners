<?php

namespace Agenciafmd\Banners;

use Agenciafmd\Admix\MediaTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Banner extends Model implements AuditableContract, HasMedia, Searchable
{
    use SoftDeletes, Auditable, HasMediaTrait, MediaTrait {
        MediaTrait::registerMediaConversions insteadof HasMediaTrait;
    }

    protected $dates = [
        'published_at',
        'until_then',
    ];

    protected $guarded = [
        'media',
    ];

    public $searchableType;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->searchableType = config('admix-banners.name');
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            "{$this->name} ({$this->email})",
            route('admix.banners.edit', $this->id)
        );
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d\TH:i', $value)
            ->format('Y-m-d H:i:s');
    }

    public function setUntilThenAttribute($value)
    {
        $this->attributes['until_then'] = null;
        if ($value) {
            $this->attributes['until_then'] = Carbon::createFromFormat('Y-m-d\TH:i', $value)
                ->format('Y-m-d H:i:s');
        }
    }

    public function scopeIsActive($query)
    {
        $query->where('is_active', 1)
            ->where('published_at', '<=', Carbon::now())
            ->where(function ($query) {
                $query->where('until_then', '>=', Carbon::now())
                    ->orWhere('until_then');
            });
    }

    public function scopeSort($query)
    {
        $sorts = default_sort(config("admix-banners.default_sort"));

        foreach ($sorts as $sort) {
            $query->orderBy($sort['field'], $sort['direction']);
        }
    }

    /*
     * Medialibrary convertions
     * */

    public $registerMediaConversionsUsingModelInstance = true;

    public function registerMediaConversions(Media $media = null)
    {
        $fields = config('admix-banners.locations.' . $this->attributes['location'] . '.items');
        foreach ($fields as $collection => $field) {
            $convertion = $this->addMediaConversion('thumb');
            if ($field['crop']) {
                $convertion->fit(Manipulations::FIT_CROP, $field['width'], $field['height']);
            } else {
                $convertion->width($field['width'])
                    ->height($field['height']);
            }
            if (!app()->environment('local')) {
                if ($field['optimize']) {
                    $convertion->optimize();
                }
                if ($field['quality']) {
                    $convertion->quality($field['quality']);
                }
            }
            $convertion->performOnCollections($collection)
                ->keepOriginalImageFormat();
        }
    }
}
