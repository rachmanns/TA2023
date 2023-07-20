<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcaraBaktiRequest extends FormRequest
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
        if (isset($this->bake)) {
            return [
                'nama_acara' => 'required',
                'id_jenis_keg' => 'required',
                'tgl_pelaksanaan' => 'required',
                'tempat' => 'required',
                'sasaran' => 'required',
                'capaian' => 'required',
                'id_keterangan' => 'required',
                'file_laporan' => 'nullable',
            ];
        }

        return [
            'nama_acara' => 'required',
            'id_jenis_keg' => 'required',
            'tgl_pelaksanaan' => 'required',
            'tempat' => 'required',
            'sasaran' => 'required',
            'capaian' => 'required',
            'id_keterangan' => 'required',
            'file_laporan' => 'nullable',
        ];
    }
}
