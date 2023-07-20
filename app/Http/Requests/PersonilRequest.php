<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonilRequest extends FormRequest
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
        if (isset($this->personil)) {
            return [
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tgl_lahir' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
                'nik' => ['required', Rule::unique('personil')->ignore($this->personil->id_personil, 'id_personil')],
                'no_telp' => 'required',
                'foto' => 'nullable|image|mimes:jpg,png,jpeg',
                'jenis_kelamin' => 'required',
                'status_pernikahan' => 'required',
                'npwp' => 'nullable',
                'no_asabri' => 'nullable',
                'no_kk' => 'nullable',
                'no_bpjs' => 'nullable',
                'no_kpis' => 'nullable',
                'email' => ['nullable', Rule::unique('personil')->ignore($this->personil->id_personil, 'id_personil')],
                'suku' => 'nullable',
                'jenis_rambut' => 'nullable',
                'warna_kulit' => 'nullable',
                'tinggi_badan' => 'nullable',
                'berat_badan' => 'nullable',
                'gol_darah' => 'nullable',
                'no_surat_nikah' => 'nullable',
                'tgl_pernikahan' => 'nullable',
                'sumber_masuk' => 'nullable',
                'kode_korps' => 'required',
                'psikologi' => 'nullable',
                'kesehatan' => 'nullable',
                'jasmani' => 'nullable',
                'dapen' => 'nullable',
                'grade' => 'nullable|numeric',
                'eselon' => 'nullable|numeric'
            ];
        }

        return [
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'nik' => 'required|unique:personil',
            'no_telp' => 'required',
            'foto' => 'required|image|mimes:jpg,png,jpeg',
            'jenis_kelamin' => 'required',
            'status_pernikahan' => 'required',
            'tmt_tni' => 'required',
            'nrp' => 'required|unique:personil',
            'kode_korps' => 'required',
            'nama_kesatuan' => 'nullable',
            'id_pangkat' => 'required',
            'tmt_pangkat' => 'required',
            'grade' => 'nullable|numeric',
            'eselon' => 'nullable|numeric',
            'id_jabatan' => 'required',
            'tmt_jabatan' => 'required',

            'npwp' => 'nullable',
            'no_asabri' => 'nullable',
            'no_kk' => 'nullable',
            'no_bpjs' => 'nullable',
            'no_kpis' => 'nullable',
            'email' => 'nullable|unique:personil',
            'suku' => 'nullable',
            'jenis_rambut' => 'nullable',
            'warna_kulit' => 'nullable',
            'tinggi_badan' => 'nullable|numeric',
            'berat_badan' => 'nullable|numeric',
            'gol_darah' => 'nullable',
            'no_surat_nikah' => 'nullable',
            'tgl_pernikahan' => 'nullable',
            'tmt_perwira' => 'nullable',
            'tmt_bintara' => 'nullable',
            'tmt_tamtama' => 'nullable',
            'psikologi' => 'nullable',
            'kesehatan' => 'nullable',
            'jasmani' => 'nullable',
            'dapen' => 'nullable',
            'no_skep_pangkat' => 'nullable',
            'tgl_skep_pangkat' => 'nullable',
            'no_sprin_pangkat' => 'nullable',
            'tgl_sprin_pangkat' => 'nullable',
            'no_skep_jabatan' => 'nullable',
            'tgl_skep_jabatan' => 'nullable',
            'no_sprin_jabatan' => 'nullable',
            'tgl_sprin_jabatan' => 'nullable',
            'sumber_masuk' => 'nullable',
        ];
    }
    protected function prepareForValidation()
    {
        if ($this->status_pernikahan == 'kawin') {
            $this['no_surat_nikah'] = $this->no_surat_nikah;
        } else {
            $this['no_surat_nikah'] = null;
        }
    }
}
