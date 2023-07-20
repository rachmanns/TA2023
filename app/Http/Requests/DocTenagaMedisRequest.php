<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocTenagaMedisRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        if (isset($this->doc_tenaga_medis)) {
            return [
                'judul' => 'required',
                'tahun' => 'required',
                'file' => 'nullable'
            ];
        }

        return [
            'judul' => 'required',
            'tahun' => 'required',
            'file' => 'required'
        ];
    }
}
