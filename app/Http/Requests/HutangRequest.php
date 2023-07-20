<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HutangRequest extends FormRequest
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
            'batalyon' => 'required',
            'operasi' => 'required',
            'jml_pers' => 'required',
            'indeks' => 'required',
            'jml_tagihan' => 'required',
            'jml_bayar' => 'required',
            'tgl_hutang' => 'required',
            'tgl_lunas' => 'nullable',
            'keterangan' => 'required'
        ];
    }
}
