{{--
use o image($banner, 'desktop')->original para a imagem sem otimização
--}}
<div class="banner-wrapper">
    <div class="slider-home">
        @foreach($banners as $k => $banner)
            <div class="index">
                <a @if($banner->link != '') href="{{ $banner->link }}" @endif target="{{ $banner->target }}" class="banner"
                   @if (config("admix-banners.locations.{$slug}.mobile") !== false) data-mobile="{{ image($banner, 'mobile')->name }}"
                   @endif
                   @if (config("admix-banners.locations.{$slug}.tablet") !== false) data-tablet="{{ image($banner, 'tablet')->name }}"
                   @endif
                   data-desktop="{{ image($banner, 'desktop')->name }}">
                </a>
            </div>
        @endforeach
    </div>
    @if($banners->count() > 1)
        <div class="slider-controllers">
            <div class="base-header">
                <div class="controllers-content">
                    <a href="#" class="btn-prev"><</a>
                    @foreach($banners as $banner)
                        <a href="#" class="btn-position @if($loop->iteration == 1) active @endif" data-position="{{ $loop->iteration }}">{{ $loop->iteration }}</a>
                    @endforeach
                    <a href="#" class="btn-next">></a>
                </div>
            </div>
        </div>
    @endif
</div>