<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StatusRequest extends FormRequest
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
        if (isset($this->status)) {
            return [
                'nama_status' => ['required', Rule::unique('status')->ignore($this->status->id_status, 'id_status')]
            ];
        }

        return [
            'nama_status' => 'required|unique:status'
        ];
    }
}
