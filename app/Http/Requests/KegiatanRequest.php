<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KegiatanRequest extends FormRequest
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
        if (isset($this->kegiatan)) {
            return [
                'nama_kegiatan' => ['required', Rule::unique('kegiatan')->ignore($this->kegiatan->id_kegiatan, 'id_kegiatan')],
                'id_event' => 'required'
            ];
        }

        return [
            'nama_kegiatan' => 'required|unique:kegiatan',
            'id_event' => 'required'
        ];
    }
}
