<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenugasanSatgasRequest extends FormRequest
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
            'id_satgas_ops' => 'required',
            'nama_batalyon' => 'required',
            'dept_date' => 'required',
            'arrv_date'      => 'required|date|after_or_equal:dept_date',
        ];
    }

    public function messages()
    {
        return [
            'id_satgas_ops.required' => 'Satgas Ops harus diisi.',
            'nama_batalyon.required' => 'Batalyon harus diisi.',
            'arrv_date.required' => 'Tanggal Pulang harus diisi.',
            'dept_date.required' => 'Tanggal Berangkat harus diisi.',
            'arrv_date.after_or_equal' => 'Tanggal pulang harus lebih dari tanggal berangkat',

        ];
    }
}
