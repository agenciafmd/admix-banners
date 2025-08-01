<?php

namespace Agenciafmd\Banners\Models;

use Agenciafmd\Admix\Traits\WithScopes;
use Agenciafmd\Admix\Traits\WithSlug;
use Agenciafmd\Banners\Database\Factories\BannerFactory;
use Agenciafmd\Banners\Observers\BannerObserver;
use Agenciafmd\Ui\Casts\AsSingleMediaLibrary;
use Agenciafmd\Ui\Traits\WithUpload;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

#[ObservedBy([BannerObserver::class])]
class Banner extends Model implements AuditableContract, HasMedia
{
    use Auditable, HasFactory, InteractsWithMedia, Prunable, SoftDeletes, WithScopes, WithSlug, WithUpload;

    protected array $defaultSort = [
        'is_active' => 'desc',
        'name' => 'asc',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'meta' => 'array',
            'published_at' => 'datetime',
            'until_then' => 'datetime',
            'desktop' => AsSingleMediaLibrary::class,
            'notebook' => AsSingleMediaLibrary::class,
            'mobile' => AsSingleMediaLibrary::class,
            'video' => AsSingleMediaLibrary::class,
        ];
    }

    public function prunable(): Builder
    {
        return static::query()->where('deleted_at', '<=', now()->subYear());
    }

    protected static function newFactory(): BannerFactory|\Database\Factories\BannerFactory
    {
        if (class_exists(\Database\Factories\BannerFactory::class)) {
            return \Database\Factories\BannerFactory::new();
        }

        return BannerFactory::new();
    }
}
