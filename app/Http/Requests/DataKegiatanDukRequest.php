<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataKegiatanDukRequest extends FormRequest
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
            'nama' => 'required',
            'kelas' => 'nullable',
            'prodi' => 'nullable',
            'jenis_kelamin' => 'nullable',
            'tb_bb' => 'required',
            'imt' => 'required',
            'tensi_nadi' => 'required',
            'peny_dalam' => 'required',
            'usg' => 'nullable',
            'obgyn' => 'nullable',
            'jantung' => 'nullable',
            'ergometri' => 'nullable',
            'paru' => 'nullable',
            'ro' => 'required',
            'lab' => 'required',
            'tht' => 'required',
            'kulit' => 'required',
            'bedah' => 'required',
            'atas' => 'required',
            'bawah' => 'required',
            'pendengaran_keseimbangan' => 'nullable',
            'mata' => 'required',
            'gigi' => 'required',
            'jiwa' => 'required',
            'hasil_um' => 'required',
            'hasil_wa' => 'required',
            'ket_nilai' => 'required',
            'ket_hasil' => 'required',
            'ekg' => 'nullable',
            'pangkat' => 'nullable',
            'jabatan' => 'nullable',
            'nrp' => 'nullable',
        ];
    }
}
