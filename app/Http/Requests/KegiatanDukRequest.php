<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KegiatanDukRequest extends FormRequest
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
            'id_kat_duk' => 'required',
            'tahun_anggaran' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required',
            'file_kegiatan' => 'required|mimes:xls,csv,xlsx|max:2000',
            'keterangan' => 'nullable',
            'jk' => 'nullable'
        ];
    }
}
