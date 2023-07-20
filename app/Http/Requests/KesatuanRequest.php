<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KesatuanRequest extends FormRequest
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
        $nama_kesatuan = $this->nama_kesatuan;

        if (isset($this->kesatuan)) {
            return [
                'kode_matra' => 'required',
                'nama_kesatuan' => ['required', Rule::unique('kesatuan')->ignore($this->kesatuan->id_kesatuan, 'id_kesatuan')->where(function ($query) use ($kode_matra, $nama_kesatuan) {
                    return $query->where('kode_matra', $kode_matra)
                        ->where('nama_kesatuan', $nama_kesatuan);
                })]
            ];
        }

        return [
            'kode_matra' => 'required',
            'nama_kesatuan' => ['required', Rule::unique('kesatuan')->where(function ($query) use ($kode_matra, $nama_kesatuan) {
                return $query->where('kode_matra', $kode_matra)
                    ->where('nama_kesatuan', $nama_kesatuan);
            })]
        ];
    }
}
