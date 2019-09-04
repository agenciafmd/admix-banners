@extends('agenciafmd/admix::partials.crud.index', [
    'route' => (request()->is('*/trash') ? route('admix.banners.trash') : route('admix.banners.index'))
])

@inject('bannerService', '\Agenciafmd\Banners\Services\BannerService')

@section('title')
    @if(request()->is('*/trash'))
        Lixeira de
    @endif
    {{ config('admix-banners.name') }}
@endsection

@section('actions')
    @if(request()->is('*/trash'))
        @include('agenciafmd/admix::partials.btn.back', ['url' => route('admix.banners.index')])
    @else
        @can('create', '\Agenciafmd\Banners\Banner')
            @include('agenciafmd/admix::partials.btn.create', ['url' => route('admix.banners.create', ['location' => null]), 'label' => config('admix-banners.name')])
        @endcan
        @can('restore', '\Agenciafmd\Banners\Banner')
            @include('agenciafmd/admix::partials.btn.trash', ['url' => route('admix.banners.trash')])
        @endcan
    @endif
@endsection

@section('batch')
    @if(request()->is('*/trash'))
        @can('restore', '\Agenciafmd\Banners\Banner')
            {{ Form::select('batch', ['' => 'com os selecionados', route('admix.banners.batchRestore') => '- restaurar'], null, ['class' => 'js-batch-select form-control custom-select']) }}
        @endcan
    @else
        @can('delete', '\Agenciafmd\Banners\Banner')
            {{ Form::select('batch', ['' => 'com os selecionados', route('admix.banners.batchDestroy') => '- remover'], null, ['class' => 'js-batch-select form-control custom-select']) }}
        @endcan
    @endif
@endsection
@section('filters')
    <h6 class="dropdown-header bg-gray-lightest p-2">Destaque</h6>
    <div class="p-2">
        {{ Form::select('filter[star]', [
                '' => '-',
                '1' => 'Sim',
                '0' => 'Não'
            ], filter('star'), [
                'class' => 'form-control form-control-sm'
            ]) }}
    </div>

    @if($bannerService->locations()->count() > 1)
        <h6 class="dropdown-header bg-gray-lightest p-2">Zona</h6>
        <div class="p-2">
            {{ Form::select('filter[location]', collect(['' => '-'])->merge($bannerService->locations()), filter('location'), ['class' => 'form-control form-control-sm']) }}
        </div>
    @endif
@endsection

@section('table')
    @if($items->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-borderless table-vcenter card-table text-nowrap">
                <thead>
                <tr>
                    <th class="w-1 d-none d-md-table-cell">&nbsp;</th>
                    <th class="w-1">{!! column_sort('#', 'id') !!}</th>
                    <th>{!! column_sort('Nome', 'name') !!}</th>
                    <th>{!! column_sort('A partir de', 'published_at') !!}</th>
                    <th>{!! column_sort('Exibir até', 'until_then') !!}</th>
                    <th>{!! column_sort('Destaque', 'star') !!}</th>
                    <th>{!! column_sort('Status', 'is_active') !!}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td class="d-none d-md-table-cell">
                            <label class="mb-1 custom-control custom-checkbox">
                                <input type="checkbox" class="js-check custom-control-input"
                                       name="check[]" value="{{ $item->id }}">
                                <span class="custom-control-label">&nbsp;</span>
                            </label>
                        </td>
                        <td><span class="text-muted">{{ $item->id }}</span></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->published_at->format('d/m/Y H:i') }}</td>
                        <td>{{ ($item->until_then) ? $item->until_then->format('d/m/Y H:i') : '-' }}</td>
                        <td>
                            @include('agenciafmd/admix::partials.label.star', ['star' => $item->star])
                        </td>
                        <td>
                            @include('agenciafmd/admix::partials.label.status', ['status' => $item->is_active])
                        </td>
                        @if(request()->is('*/trash'))
                            <td class="w-1 text-right">
                                @include('agenciafmd/admix::partials.btn.restore', ['url' => route('admix.banners.restore', $item->id)])
                            </td>
                        @else
                            <td class="w-1 text-center">
                                <div class="item-action dropdown">
                                    <a href="#" data-toggle="dropdown" class="icon">
                                        <i class="icon fe-more-vertical text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @include('agenciafmd/admix::partials.btn.show', ['url' => route('admix.banners.show', [$item->id, $item->location])])
                                        @can('update', '\Agenciafmd\Banners\Banner')
                                            @include('agenciafmd/admix::partials.btn.edit', ['url' => route('admix.banners.edit', [$item->id, $item->location])])
                                        @endcan
                                        @can('delete', '\Agenciafmd\Banners\Banner')
                                            @include('agenciafmd/admix::partials.btn.remove', ['url' => route('admix.banners.destroy', $item->id)])
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! $items->appends(request()->except(['page']))->links() !!}
    @else
        @include('agenciafmd/admix::partials.info.not-found')
    @endif
@endsection

@push('scripts')
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="Escolha o local do banner"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Qual a localização?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::select('modalLocation', $bannerService->locations(), null, ['id' => 'modalLocation', 'style' => 'width: 100%', 'class' => 'form-control']) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-action-continue">Continuar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            var btn = $('.card-options > .btn-primary');
            btn.unbind('click').on('click', function (e) {
                e.preventDefault();
                var _this = $(this);

                @if($bannerService->locations()->count() == 1)
                    window.location.href = _this.attr('href') + "/{{ $bannerService->locations()->keys()->first() }}"
                @else
                $('#createModal').modal();
                $('.btn-action-continue').on('click', function () {
                    window.location.href = _this.attr('href') + '/' + $('#modalLocation').val()
                })
                @endif
            });
        });
    </script>
@endpush