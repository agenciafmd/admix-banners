<?php

namespace Agenciafmd\Banners\Models;

use Database\Factories\BannerFactory;
use Agenciafmd\Media\Traits\MediaTrait;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Banner extends Model implements AuditableContract, HasMedia, Searchable
{
    use SoftDeletes, HasFactory, Auditable, MediaTrait;

    protected $dates = [
        'published_at',
        'until_then',
    ];

    protected $guarded = [
        'media',
    ];

    protected $casts = [
        'meta' => 'array',
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
            "{$this->name}",
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

    protected static function newFactory()
    {
        return BannerFactory::new();
    }

    public $registerMediaConversionsUsingModelInstance = true;

    public function fieldsToConversion()
    {
        $modelName = strtolower(class_basename($this));

        return config("upload-configs.{$modelName}.{$this->attributes['location']}");
    }
}
