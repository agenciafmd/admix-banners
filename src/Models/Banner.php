<?php

namespace Agenciafmd\Banners\Models;

use Agenciafmd\Admix\Traits\WithScopes;
use Agenciafmd\Admix\Traits\WithSlug;
use Agenciafmd\Banners\Database\Factories\BannerFactory;
use Agenciafmd\Ui\Casts\AsSingleMediaLibrary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Banner extends Model implements AuditableContract, HasMedia
{
    use Auditable, HasFactory, InteractsWithMedia, Prunable, SoftDeletes, WithScopes, WithSlug;

    protected $fillable = [
        'is_active',
        'star',
        'name',
        'meta',
        'link',
        'target',
        'published_at',
        'until_then',
    ];

    protected array $defaultSort = [
        'is_active' => 'desc',
        'name' => 'asc',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'published_at' => 'datetime',
            'until_then' => 'datetime',
            'desktop' => AsSingleMediaLibrary::class,
            'notebook' => AsSingleMediaLibrary::class,
            'mobile' => AsSingleMediaLibrary::class,
        ];
    }

    public function prunable(): Builder
    {
        return self::where('deleted_at', '<=', now()->subYear());
    }

    protected static function newFactory(): BannerFactory|\Database\Factories\BannerFactory
    {
        if (class_exists(\Database\Factories\BannerFactory::class)) {
            return \Database\Factories\BannerFactory::new();
        }

        return BannerFactory::new();
    }
}
