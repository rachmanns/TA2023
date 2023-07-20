<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PangkatRequest extends FormRequest
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
        $kode_matra = $this->kode_matra;
        $nama_pangkat = $this->nama_pangkat;

        if (isset($this->pangkat)) {
            return [
                'kode_matra' => 'required',
                'nama_pangkat' => ['required', Rule::unique('pangkat')->ignore($this->pangkat->id_pangkat, 'id_pangkat')->where(function ($query) use ($kode_matra, $nama_pangkat) {
                    return $query->where('kode_matra', $kode_matra)
                        ->where('nama_pangkat', $nama_pangkat);
                })],
                'jenis_pangkat' => 'required',
                'masa_kenkat' => 'required',
                'next_pangkat' => 'nullable',
                'usia_pensiun' => 'required'
            ];
        }
        return [
            'kode_matra' => 'required',
            'nama_pangkat' => ['required', Rule::unique('pangkat')->where(function ($query) use ($kode_matra, $nama_pangkat) {
                return $query->where('kode_matra', $kode_matra)
                    ->where('nama_pangkat', $nama_pangkat);
            })],
            'jenis_pangkat' => 'required',
            'masa_kenkat' => 'required',
            'next_pangkat' => 'nullable',
            'usia_pensiun' => 'required'
        ];
    }
}
