<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HibahRequest extends FormRequest
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
        if (isset($this->ba_hibah)) {
            return [
                'no_ba_hibah' => 'required',
                'tgl_ba_hibah' => 'required',
                'id_vendor' => 'required',
                'kode_ba_hibah' => 'required',
                'nominal' => 'required',
                'file_ba_hibah' => 'nullable',
            ];
        }

        return [
            'no_ba_hibah' => 'required',
            'tgl_ba_hibah' => 'required',
            'id_vendor' => 'required',
            'kode_ba_hibah' => 'required',
            'nominal' => 'required',
            'file_ba_hibah' => 'required',
        ];
    }
}
