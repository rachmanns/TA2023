<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PosSatgasRequest extends FormRequest
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
            'nama_pos' => 'required',
            'id_satgas_ops' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'status_endemik' => 'required',
            'id_geografis' => 'required',
            'pendapatan' => 'nullable',
            'kepadatan' => 'nullable',
            'ekonomi' => 'nullable',
            'sosial' => 'nullable',
            'budaya' => 'nullable',
            'ideologi' => 'nullable',
            // 'pendapatan' => 'required',
            // 'kepadatan' => 'required',
            // 'ekonomi' => 'required',
            // 'sosial' => 'required',
            // 'budaya' => 'required',
            // 'ideologi' => 'required',
            'keterangan' => 'nullable',
            'tipe' => 'required',
            'rs_pemda_swasta' => 'nullable'
        ];
    }
}
