<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class KorpsRequest extends FormRequest
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
        if (isset($this->korps)) {
            return [
                'kode_matra' => 'required',
                'nama_korps' => 'required',
                'kode_korps' => ['required', Rule::unique('korps')->ignore($this->korps->id_korps, 'id_korps')]
            ];
        }
        return [
            'kode_matra' => 'required',
            'kode_korps' => 'required|unique:korps',
            'nama_korps' => 'required'
        ];
    }
}
