<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventBukuRequest extends FormRequest
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
        if (isset($this->event_buku)) {
            return [
                'id_kotakab' => 'required',
                'id_buku' => 'required',
                'tgl_event' => 'required',
                'satuan' => 'required',
                'jml_peserta' => 'required',
                'file_lap_keg' => 'nullable|mimes:doc,pdf,docx',
                'status_keg' => 'required',
                'id_personil' => 'required'
            ];
        }

        return [
            'id_kotakab' => 'required',
            'id_buku' => 'required',
            'tgl_event' => 'required',
            'satuan' => 'required',
            'jml_peserta' => 'required',
            'file_lap_keg' => 'nullable|mimes:doc,pdf,docx',
            'status_keg' => 'required',
            'id_personil' => 'required'
        ];
    }
}
