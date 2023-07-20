<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
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

        if (isset($this->buku)) {
            return [
                'id_kat_buku' => 'required',
                'no_buku' => 'required',
                'nama_buku' => 'required',
                'tahun_terbit' => 'required',
                'abstraksi' => 'required',
                'file_buku' => 'nullable|mimes:pdf'
            ];
        }

        return [
            'id_kat_buku' => 'required',
            'no_buku' => 'required',
            'nama_buku' => 'required',
            'tahun_terbit' => 'required',
            'abstraksi' => 'required',
            'file_buku' => 'required|mimes:pdf'
        ];
    }
}
