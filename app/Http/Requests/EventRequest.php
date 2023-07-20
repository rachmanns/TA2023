<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
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

        if (isset($this->event)) {
            return [
                'nama_event' => ['required', Rule::unique('event')->ignore($this->event->id_event, 'id_event')],
                'id_jenis_kerma' => 'required'
            ];
        }

        return [
            'nama_event' => 'required|unique:event',
            'id_jenis_kerma' => 'required'
        ];
    }
}
