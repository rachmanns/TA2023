<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BekkesDukRequest extends FormRequest
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

        if (isset($this->satgas_ln) || isset($this->satgas_dn)) {
            return [
                'tahun' => 'required',
                'no_surat' => 'required',
                'jumlah' => 'nullable|numeric',
                'satgas' => 'nullable',
                'file_disetujui' => 'nullable|mimes:pdf',
            ];
        }

        return [
            'tahun' => 'required',
            'no_surat' => 'required',
            'jumlah' => 'nullable|numeric',
            'satgas' => 'nullable',
            'file_disetujui' => 'required|mimes:pdf',
        ];
    }
}
