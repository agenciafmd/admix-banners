@extends('agenciafmd/admix::partials.crud.form')

@section('form')
    {{ Form::bsOpen(['model' => optional($model), 'create' => route('admix.banners.store'), 'update' => route('admix.banners.update', ['banner' => ($model->id) ?? 0])]) }}
    <div class="card-header bg-gray-lightest">
        <h3 class="card-title">
            @if(request()->is('*/create'))
                Criar
            @elseif(request()->is('*/edit'))
                Editar
            @else
                Visualizar
            @endif
            {{ config('admix-banners.name') }}
        </h3>
        <div class="card-options">
            @include('agenciafmd/admix::partials.btn.save')
        </div>
    </div>
    <ul class="list-group list-group-flush">

        @if (optional($model)->id)
            {{ Form::bsText('Código', 'id', null, ['disabled' => true]) }}
        @endif

        {{ Form::hidden('location', request()->route()->parameter('location')) }}

        {{ Form::bsIsActive('Ativo', 'is_active', null, ['required']) }}

        {{ Form::bsBoolean('Destaque', 'star', null, ['required' => true]) }}

        {{ Form::bsText('Nome', 'name', null, ['required']) }}

        @foreach(config('upload-configs.banner.' . (($model->location) ?? request()->route()->parameter('location'))) as $item => $size)
            {{ Form::bsImage(ucfirst($item), $item, $model, ['config' => $size['sources'][0]]) }}
        @endforeach

        @if(config('admix-banners.locations.' . (($model->location) ?? request()->route()->parameter('location')) . '.html') == true)
            {{ Form::bsTextarea('Conteúdo HTML', 'description', optional($model)->description ?? null) }}
        @endif

        @if(config('admix-banners.locations.' . (($model->location) ?? request()->route()->parameter('location')) . '.meta'))
            @foreach (config('admix-banners.locations.' . (($model->location) ?? request()->route()->parameter('location')) . '.meta') as $field)
                @if (isset($field['options']) && is_array($field['options']))
                    {{ Form::bsSelect($field['label'], "meta['{$field['name']}']", ['' => '-'] + $field['options'], $model->meta[$field['name']]) }}
                @else
                    {{ Form::bsText($field['label'], "meta['{$field['name']}']", $model->meta[$field['name']]) }}
                @endif
            @endforeach
        @else
            {{ Form::hidden('meta[]', '') }}
        @endif

        {{ Form::bsText('Link', 'link', null) }}

        {{ Form::bsSelect('Abrir o link', 'target', ['' => '-', '_self' => 'na mesma página', '_blank' => 'em uma nova janela'], null, ['required' => true]) }}

        {{ Form::bsDateTime('Exibir a partir de', 'published_at', optional(optional($model)->published_at)->format("Y-m-d\TH:i"), ['required']) }}

        {{ Form::bsDateTime('Exibir até', 'until_then', optional(optional($model)->until_then)->format("Y-m-d\TH:i")) }}
    </ul>
    <div class="card-footer bg-gray-lightest text-right">
        <div class="d-flex">
            @include('agenciafmd/admix::partials.btn.back')
            @include('agenciafmd/admix::partials.btn.save')
        </div>
    </div>
    {{ Form::close() }}
@endsection
