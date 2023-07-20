<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TandaJasaRequest extends FormRequest
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
        $nama_jasa = $this->nama_jasa;
        $keterangan = $this->keterangan;

        if ($this->tanda_jasa) {
            return [
                'nama_jasa' => ['required', Rule::unique('tanda_jasa')->ignore($this->tanda_jasa->id_jasa, 'id_jasa')->where(function ($query) use ($nama_jasa, $keterangan) {
                    return $query->where('nama_jasa', $nama_jasa)
                        ->where('keterangan', $keterangan);
                })],
                'keterangan' => 'required'
            ];
        }

        return [
            'nama_jasa' => ['required', Rule::unique('tanda_jasa')->where(function ($query) use ($nama_jasa, $keterangan) {
                return $query->where('nama_jasa', $nama_jasa)
                    ->where('keterangan', $keterangan);
            })],
            'keterangan' => 'required'
        ];
    }
}
