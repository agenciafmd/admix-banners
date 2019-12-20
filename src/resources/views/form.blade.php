@extends('agenciafmd/admix::partials.crud.form')

@section('form')
    @formModel(['model' => optional($model), 'create' => route('admix.banners.store'), 'update' => route('admix.banners.update', [($model->id) ?? 0]), 'id' => 'formCrud', 'class' => 'mb-0 card-list-group card' . ((count($errors) > 0) ? ' was-validated' : '')])
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
            @formText(['Código', 'id', null, ['disabled' => true]])
        @endif

        @inputHidden(['location', request()->route()->parameter('location')])

        @formIsActive(['Ativo', 'is_active', null, ['required']])

        @formBoolean(['Destaque', 'star', null, ['required']])

        @formText(['Nome', 'name', null, ['required']])

        @foreach(config('admix-banners.locations.' . request()->route()->parameter('location') . '.items') as $item => $size)
            @formImage([ucfirst($item), $item, $model, ['config' => config('admix-banners.locations.' .
            request()->route()->parameter('location') . '.items')]])
        @endforeach

        @if(config('admix-banners.locations.' . request()->route()->parameter('location') . '.html') == true)
            @formTextareaPlain(['Conteúdo HTML', 'description', optional($model)->description ?? null])
        @endif

        @formText(['Link', 'link', null])

        @formSelect(['Abrir o link', 'target', ['' => '-', '_self' => 'na mesma página', '_blank' => 'em uma nova
        janela'], null, ['required']])

        @formDatetime(['Exibir a partir de', 'published_at', null, ['required']])

        @formDatetime(['Exibir até', 'until_then', null])
    </ul>
    <div class="card-footer bg-gray-lightest text-right">
        <div class="d-flex">
            @include('agenciafmd/admix::partials.btn.back')

            @if(strpos(request()->route()->getName(), 'show') === false)
                @include('agenciafmd/admix::partials.btn.save')
            @endif
        </div>
    </div>
    @formClose()
@endsection
