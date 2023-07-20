<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JabatanRequest extends FormRequest
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

        if (isset($this->jabatan)) {
            return [
                'nama_jabatan' => ['required', Rule::unique('jabatan')->ignore($this->jabatan->id_jabatan, 'id_jabatan')]
            ];
        }

        return [
            'nama_jabatan' => 'required|unique:jabatan'
        ];
    }
}
