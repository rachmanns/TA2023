<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailBekkesRequest extends FormRequest
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
            'id_data_bekkes' => 'required',
            'id_kategori_brg' => 'required',
            'jenis_brg' => 'required',
            'nama_brg' => 'required',
            'satuan' => 'required',
            'jml' => 'required',
            'keterangan' => 'required'
        ];
    }
}
