<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PesertaBangkesRequest extends FormRequest
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
            'id_pelatihan_bangkes' => 'required',
            'nama' => 'required',
            'matra' => 'required',
            'pangkat_korps' => 'required',
            'nrp' => 'required|numeric',
            'satuan' => 'required',
            'keterangan' => 'required'
        ];
    }
}
