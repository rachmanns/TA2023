<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PakaianRequest extends FormRequest
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
        if (isset($this->pakaian)) {
            return [
                'item_pakaian' => ['required', Rule::unique('pakaian')->ignore($this->pakaian->id_pakaian, 'id_pakaian')]
            ];
        }

        return [
            'item_pakaian' => 'required|unique:pakaian'
        ];
    }
}
