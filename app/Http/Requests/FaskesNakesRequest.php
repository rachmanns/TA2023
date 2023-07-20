<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaskesNakesRequest extends FormRequest
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
            'klasifikasi' => 'required',
            'matra' => 'nullable',
            'id_spesialis' => 'required',
            'nama_dokter' => 'required',
            'pangkat_korps' => 'nullable',
            'no_identitas' => 'required',
            'satuan_asal' => 'nullable',
            'jabatan_struktural' => 'required',
            'jabatan_fungsional' => 'required',
            'keterangan' => 'required',
            'jenjang' => 'required'
        ];
    }
}
