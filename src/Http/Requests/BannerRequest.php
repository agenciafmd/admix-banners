<?php

namespace Agenciafmd\Banners\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'is_active' => 'required|boolean',
            'star' => 'required|boolean',
            'name' => 'required|max:150',
            'published_at' => 'required|date_format:Y-m-d\TH:i',
            'until_then' => 'nullable|date_format:Y-m-d\TH:i',
        ];
    }

    public function attributes()
    {
        return [
            'is_active' => 'ativo',
            'star' => 'destaque',
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
