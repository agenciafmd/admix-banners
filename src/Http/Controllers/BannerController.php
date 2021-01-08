<?php

namespace Agenciafmd\Banners\Http\Controllers;

use Agenciafmd\Admix\Http\Filters\GreaterThanFilter;
use Agenciafmd\Admix\Http\Filters\LowerThanFilter;
use Agenciafmd\Banners\Models\Banner;
use Agenciafmd\Banners\Http\Requests\BannerRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        session()->put('backUrl', request()->fullUrl());

        $query = QueryBuilder::for(Banner::class)
            ->defaultSorts(config('admix-banners.default_sort'))
            ->allowedSorts($request->sort)
            ->allowedFilters(array_merge((($request->filter) ? array_keys(array_diff_key($request->filter, array_flip(['id', 'is_active', 'star', 'location', 'published_at_gt', 'until_then_lt']))) : []), [
                AllowedFilter::exact('id'),
                AllowedFilter::exact('is_active'),
                AllowedFilter::exact('star'),
                AllowedFilter::exact('location'),
                AllowedFilter::custom('published_at_gt', new GreaterThanFilter),
                AllowedFilter::custom('until_then_lt', new LowerThanFilter),
            ]));

        if ($request->is('*/trash')) {
            $query->onlyTrashed();
        }

        $view['items'] = $query->paginate($request->get('per_page', 50));

        return view('agenciafmd/banners::index', $view);
    }

    public function create(Banner $banner)
    {
        $view['model'] = $banner;

        return view('agenciafmd/banners::form', $view);
    }

    public function store(BannerRequest $request)
    {
        if (Banner::create($request->validated())) {
            flash('Item inserido com sucesso.', 'success');
        } else {
            flash('Falha no cadastro.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.banners.index');
    }

    public function show(Banner $banner)
    {
        $view['model'] = $banner;

        return view('agenciafmd/banners::form', $view);
    }

    public function edit(Banner $banner)
    {
        $view['model'] = $banner;

        return view('agenciafmd/banners::form', $view);
    }

    public function update(Banner $banner, BannerRequest $request)
    {
        if ($banner->update($request->validated())) {
            flash('Item atualizado com sucesso.', 'success');
        } else {
            flash('Falha na atualização.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.banners.index');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->delete()) {
            flash('Item removido com sucesso.', 'success');
        } else {
            flash('Falha na remoção.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.banners.index');
    }

    public function restore($id)
    {
        $banner = Banner::onlyTrashed()
            ->find($id);

        if (!$banner) {
            flash('Item já restaurado.', 'danger');
        } elseif ($banner->restore()) {
            flash('Item restaurado com sucesso.', 'success');
        } else {
            flash('Falha na restauração.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.banners.index');
    }

    public function batchDestroy(Request $request)
    {
        if (Banner::destroy($request->get('id', []))) {
            flash('Item removido com sucesso.', 'success');
        } else {
            flash('Falha na remoção.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.banners.index');
    }

    public function batchRestore(Request $request)
    {
        $banner = Banner::onlyTrashed()
            ->whereIn('id', $request->get('id', []))
            ->restore();

        if ($banner) {
            flash('Item restaurado com sucesso.', 'success');
        } else {
            flash('Falha na restauração.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.banners.index');
    }
}
