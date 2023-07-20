<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupervisiRequest extends FormRequest
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

        if (isset($this->supervisi)) {
            return [
                'topik' => 'required',
                'tgl' => 'required',
                'satuan' => 'required',
                'id_kotakab' => 'required',
                'provinsi' => 'required',
                'file_lap_keg' => 'nullable|mimes:doc,pdf,docx',
                'panitia_internal' => 'nullable',
                'panitia_eksternal' => 'nullable',
            ];
        }

        return [
            'topik' => 'required',
            'tgl' => 'required',
            'satuan' => 'required',
            'id_kotakab' => 'required',
            'provinsi' => 'required',
            'file_lap_keg' => 'nullable|mimes:doc,pdf,docx',
            'panitia_internal' => 'nullable',
            'panitia_eksternal' => 'nullable',
        ];
    }
}
