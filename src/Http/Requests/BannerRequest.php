<?php

namespace Agenciafmd\Banners\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    protected $errorBag = 'admix';

    public function rules()
    {
        return [
            'is_active' => [
                'required',
                'boolean',
            ],
            'star' => [
                'required',
                'boolean',
            ],
            'location' => [
                'required',
            ],
            'name' => [
                'required',
                'max:150',
            ],
            'media' => [
                'array',
                'nullable',
            ],
            'meta' => [
                'array',
            ],
            'description' => [
                'nullable'
            ],
            'link' => [
                'nullable'
            ],
            'target' => [
                'nullable'
            ],
            'published_at' => [
                'required',
                'date_format:Y-m-d\TH:i',
            ],
            'until_then' => [
                'nullable',
                'date_format:Y-m-d\TH:i',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'is_active' => 'ativo',
            'star' => 'destaque',
            'location' => 'local',
            'name' => 'nome',
            'published_at' => 'data de publicação',
            'until_then' => 'exibir até',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
