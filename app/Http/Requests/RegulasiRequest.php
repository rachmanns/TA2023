<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegulasiRequest extends FormRequest
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

        if (isset($this->regulasi)) {
            return [
                'nama_regulasi' => 'required',
                'id_kat_buku' => 'required',
                'file' => 'nullable'
            ];
        }

        return [
            'id_bidang' => 'required',
            'nama_regulasi' => 'required',
            'id_kat_buku' => 'required',
            'file' => 'required'
        ];
    }
}
