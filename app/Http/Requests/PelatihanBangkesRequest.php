<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelatihanBangkesRequest extends FormRequest
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
            'id_jenis_pelatihan' => 'required',
            'tgl_pelaksanaan' => 'required',
            'tempat' => 'required'
        ];
    }
}
