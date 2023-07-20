<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcaraKermaRequest extends FormRequest
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

        if (isset($this->bilateral) || isset($this->nonbilateral) || isset($this->kdn)) {
            return [
                'nama_acara' => 'required',
                'id_kegiatan' => 'required',
                'id_jenis_keg' => 'required',
                'tgl_pelaksanaan' => 'required',
                'tempat' => 'required',
                'id_keterangan' => 'required',
                'id_status' => 'required',
                'file_laporan' => 'nullable',
                'periode' => 'required'
            ];
        }

        return [
            'nama_acara' => 'required',
            'id_kegiatan' => 'required',
            'id_jenis_keg' => 'required',
            'tgl_pelaksanaan' => 'required',
            'tempat' => 'required',
            'id_keterangan' => 'required',
            'id_status' => 'required',
            'file_laporan' => 'nullable',
            'periode' => 'required'
        ];
    }
}
