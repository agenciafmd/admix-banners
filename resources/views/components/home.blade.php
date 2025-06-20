<div class="slider-container">
    <div class="js-slider-banner">
        @foreach ($banners as $banner)
            <div>
                <a href="{{ $banner['link'] }}" target="{{ $banner['target'] }}">
                    <picture>
                        @foreach($banner['images'] as $mediaQuery => $responsiveImages)
                            <source media="{{ $mediaQuery }}"
                                    srcset="{{ $responsiveImages->getSrcset() }}">
                        @endforeach
                        <img src="data:image/png;base64, R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                             loading="lazy"
                             alt="{{ $banner['name'] }}"
                             title="{{ $banner['name'] }}"
                             class="img-sanitize">
                    </picture>
                </a>
            </div>
        @endforeach
    </div>
</div>