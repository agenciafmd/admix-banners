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
            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
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

        @foreach(config('admix-banners.locations.' . request()->route()->parameter('location') . '.items') as $item => $size)
            {{ Form::bsImage(ucfirst($item), $item, $model, ['config' => config('admix-banners.locations.' . request()->route()->parameter('location') . '.items')]) }}
        @endforeach

        @if(config('admix-banners.locations.' . request()->route()->parameter('location') . '.html') == true)
            {{ Form::bsTextareaPlain('Conteúdo HTML', 'description', optional($model)->description ?? null) }}
        @endif

        @if(config('admix-banners.locations.' . request()->route()->parameter('location') . '.meta'))
            @foreach (config('admix-banners.locations.' . request()->route()->parameter('location') . '.meta') as $field)
                @if (isset($field['options']) && is_array($field['options']))
                    {{ Form::bsSelect($field['label'], "meta[{$field['name']}]", ['' => '-'] + $field['options'], null) }}
                @else
                    {{ Form::bsText($field['label'], "meta[{$field['name']}]", null) }}
                @endif
            @endforeach
        @endif

{{--        if (config("upload-configs.{$modelName}.{$collectionName}.meta")) {--}}
{{--        foreach (config("upload-configs.{$modelName}.{$collectionName}.meta") as $field) {--}}
{{--        $html .= '--}}
{{--        <li class="list-group-item mb-4">--}}
{{--            <div class="row gutters-sm">--}}
{{--                <label for="Descrição" class="col-xl-3 col-form-label pt-0 pt-xl-2">' . ucfirst($field['label']) .--}}
{{--                    '</label>--}}
{{--                <div class="col-xl-5">';--}}
{{--                    if (isset($field['options']) && is_array($field['options'])) {--}}
{{--                    $html .= '<select class="form-control" name="meta[' . $field['name'] . ']">--}}
{{--                        <option value="">-</option>--}}
{{--                        ';--}}
{{--                        foreach ($field['options'] as $option) {--}}
{{--                        $html .= '--}}
{{--                        <option value="' . $option . '"--}}
{{--                        ' . (($media->getCustomProperty("meta." . $field['name']) == $option) ? 'selected' : '') . '>' .--}}
{{--                        $option . '</option>';--}}
{{--                        }--}}
{{--                        $html .= '</select>';--}}
{{--                    } else {--}}
{{--                    $html .= '<input class="form-control" name="meta[' . $field['name'] . ']" type="text"--}}
{{--                                     value="' . (($media->getCustomProperty(" meta." . $field['name'])) ?? '') . '">';--}}
{{--                    }--}}

{{--                    $html .= '--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        o campo ' . strtolower($field['label']) . ' é obrigatório--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </li>--}}
{{--        ';--}}
{{--        }--}}
{{--        }--}}

        {{ Form::bsText('Link', 'link', null) }}

        {{ Form::bsSelect('Abrir o link', 'target', ['' => '-', '_self' => 'na mesma página', '_blank' => 'em uma nova janela'], null, ['required' => true]) }}

        {{ Form::bsDateTime('Exibir a partir de', 'published_at', optional(optional($model)->published_at)->format("Y-m-d\TH:i"), ['required']) }}

        {{ Form::bsDateTime('Exibir até', 'until_then', optional(optional($model)->until_then)->format("Y-m-d\TH:i")) }}
    </ul>
    <div class="card-footer bg-gray-lightest text-right">
        <div class="d-flex">
            @include('agenciafmd/admix::partials.btn.back')

            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
        </div>
    </div>
    {{ Form::close() }}
@endsection
