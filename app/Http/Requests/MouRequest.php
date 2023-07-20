<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MouRequest extends FormRequest
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

        if (isset($this->mou)) {
            return [
                'jenis_doc_kerma' => 'required',
                'pihak' => 'required',
                'lembaga' => 'required',
                'no_doc' => ['required', Rule::unique('doc_kerma')->ignore($this->mou->id_doc_kerma, 'id_doc_kerma')],
                'tgl_terbit' => 'required',
                'tgl_berakhir' => 'required',
                'desc' => 'required',
                'keterangan' => 'required',
                'id_parent_doc' => 'nullable',
                'file_doc' => 'nullable'
            ];
        }

        return [
            'jenis_doc_kerma' => 'required',
            'pihak' => 'required',
            'lembaga' => 'required',
            'no_doc' => 'required|unique:doc_kerma',
            'tgl_terbit' => 'required',
            'tgl_berakhir' => 'required',
            'desc' => 'required',
            'keterangan' => 'required',
            'id_parent_doc' => 'nullable',
            'file_doc' => 'required'
        ];
    }
}
