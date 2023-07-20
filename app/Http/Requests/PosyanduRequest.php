<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PosyanduRequest extends FormRequest
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
            'id_matra' => 'required',
            'nama_posy' => 'required',
            'alamat_posy' => 'required',
            'id_kotakab' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'prog_germas' => 'required',
            'prog_posy' => 'required',
            'hub_sektoral' => 'required',
            'jml_kader_germas' => 'required',
            'jml_kader_posy' => 'required'
        ];
    }
}
