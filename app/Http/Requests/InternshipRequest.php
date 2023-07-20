<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InternshipRequest extends FormRequest
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
        if (isset($this->internship)) {
            return [
                'nrp' => ['required', Rule::unique('internship')->ignore($this->internship->id_internship, 'id_internship')],
                'matra' => 'required',
                'nama' => 'required',
                'pangkat' => 'required',
                'korps' => 'required',
                'jabatan' => 'required',
                'kesatuan' => 'required',
                'wahana' => 'required',
                'tgl_mulai' => 'required'
            ];
        }

        return [
            'matra' => 'required',
            'nama' => 'required',
            'pangkat' => 'required',
            'korps' => 'required',
            'nrp' => 'required|numeric|unique:internship',
            'jabatan' => 'required',
            'kesatuan' => 'required',
            'wahana' => 'required',
            'tgl_mulai' => 'required'
        ];
    }
}
