<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CicilanRequest extends FormRequest
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

        if (isset($this->cicilan)) {
            return [
                'id_hutang' => 'required',
                'tgl_bayar' => 'required',
                'jml_bayar' => 'required',
                'bukti_bayar' => 'nullable',
            ];
        }

        return [
            'id_hutang' => 'required',
            'tgl_bayar' => 'required',
            'jml_bayar' => 'required',
            'bukti_bayar' => 'required',
        ];
    }
}
