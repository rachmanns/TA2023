<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UraianRequest extends FormRequest
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
            'kode_bidang' => 'required',
            'kode_dipa' => 'required',
            'kode_akun' => 'nullable',
            'nama_uraian' => 'required',
            'pagu_awal' => 'required',
            'tahun_anggaran' => 'required'
        ];
    }
}
