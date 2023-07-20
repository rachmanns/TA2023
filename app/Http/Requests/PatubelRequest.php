<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatubelRequest extends FormRequest
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
        if (isset($this->patubel)) {
            return [
                'tmt' => 'required',
                'tmt_awal' => 'nullable',
                'tmt_akhir' => 'nullable',
                'file_sprin' => 'nullable|mimes:doc,pdf,docx',
                'peminatan2' => 'nullable',
                'kampus2' => 'nullable',
                'peminatan' => 'nullable',
                'kampus' => 'nullable',
                'file_sprin2' => 'nullable|mimes:doc,pdf,docx',
                'status' => 'nullable',
                'tgl_lulus' => 'nullable',
                'ipk' => 'nullable',
                'semester' => 'nullable',
                'tahun' => 'nullable|numeric',
                'jenjang' => 'nullable',
                'matra' => 'nullable',
            ];
        }

        return [
            'semester' => 'required',
            'tahun' => 'required|numeric',
            'ket_peserta' => 'required',
            'id_nakes' => 'required',
            'jenjang' => 'required',
            'peminatan' => 'required',
            'kampus' => 'required',
            'matra' => 'nullable',
        ];
    }
}
