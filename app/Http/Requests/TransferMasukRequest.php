<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferMasukRequest extends FormRequest
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
        if (isset($this->in_tktm)) {
            return [
                'no_kontrak_tktm' => 'required',
                'nominal' => 'required',
                'tgl_kontrak_tktm' => 'required',
                'pelaksana_tktm' => 'required',
                'file_kontrak_tktm' => 'nullable',

                'no_rth_tm' => 'required_with:file_rth_tm',
                // 'no_rth_tk' => 'nullable',
                'file_rth_tm' => 'nullable',
                // 'file_rth_tk' => 'nullable|mimes:jpg,pdf,png',
            ];
        }

        return [
            'no_kontrak_tktm' => 'required',
            'nominal' => 'required',
            'tgl_kontrak_tktm' => 'required',
            'pelaksana_tktm' => 'required',
            'file_kontrak_tktm' => 'required',

            'no_rth_tm' => 'required_with:file_rth_tm',
            // 'no_rth_tk' => 'nullable',
            'file_rth_tm' => 'nullable',
            // 'file_rth_tk' => 'nullable|mimes:jpg,pdf,png',
        ];
    }
}
