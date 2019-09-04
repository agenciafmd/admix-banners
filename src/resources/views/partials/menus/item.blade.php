@can('view', '\Agenciafmd\Banners\Banner')
    <li class="nav-item">
        <a class="nav-link {{ (admix_is_active(route('admix.banners.index'))) ? 'active' : '' }}"
           href="{{ route('admix.banners.index') }}"
           aria-expanded="{{ (admix_is_active(route('admix.banners.index'))) ? 'true' : 'false' }}">
        <span class="nav-icon">
            <i class="icon {{ config('admix-banners.icon') }}"></i>
        </span>
            <span class="nav-text">
            {{ config('admix-banners.name') }}
        </span>
        </a>
    </li>
@endcan
