<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BekkesPenugasanRequest extends FormRequest
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
            'nama_satgas' => 'required',
            'operasi' => 'required',
            'tgl_berangkat' => 'required',
            'tgl_kembali' => 'required',
            'jumlah_pers' => 'required',
            'endemik' => 'required',
            'keterangan' => 'required',
            'jenis_satgas' => 'required'
        ];
    }
}
