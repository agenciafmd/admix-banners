@can('view', \Agenciafmd\Banners\Models\Banner::class)
    <li class="nav-item">
        <a class="nav-link  {{ (Str::startsWith(request()->route()->getName(), 'admix.banners')) ? 'active' : '' }}"
           href="{{ route('admix.banners.index') }}"
           aria-expanded=" {{ (Str::startsWith(request()->route()->getName(), 'admix.banners')) ? 'true' : 'false' }}">
        <span class="nav-icon">
            <i class="icon {{ config('admix-banners.icon') }}"></i>
        </span>
            <span class="nav-text">
            {{ config('admix-banners.name') }}
        </span>
        </a>
    </li>
@endcan
