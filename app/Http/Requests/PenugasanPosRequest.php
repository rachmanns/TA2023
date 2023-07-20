<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenugasanPosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_ketua' => 'required',
            'jml_personil' => 'required',
            'no_telp' => 'required',
            'id_mas_bek' => 'nullable'
        ];
    }
}
