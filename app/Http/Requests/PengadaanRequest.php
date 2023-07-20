<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengadaanRequest extends FormRequest
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

        if (isset($this->kontrak)) {
            return [
                'kode_kontrak' => 'required',
                'id_vendor' => 'nullable',
                'nomor_kontrak' => 'nullable',
                'tgl_kontrak' => 'nullable',
                'masa_berlaku' => 'nullable',
                'file_kontrak' => 'nullable',
                'nominal_kontrak' => 'required',
                'nama_kegiatan' => 'required',
                'no_dipa' => 'required',
                'kode_dipa' => 'required',
                'tgl_dipa' => 'required',
                'jumlah' => 'required',
                'dasar_pengadaan' => 'nullable',
                'file_pendukung' => 'nullable',
                'tgl_kegiatan_pengadaan' => 'required'
            ];
        }

        return [
            'kode_kontrak' => 'required',
            'id_vendor' => 'nullable',
            'nomor_kontrak' => 'nullable',
            'tgl_kontrak' => 'nullable',
            'masa_berlaku' => 'nullable',
            'file_kontrak' => 'nullable',
            'nominal_kontrak' => 'required',
            'nama_kegiatan' => 'required',
            'no_dipa' => 'required',
            'kode_dipa' => 'required',
            'tgl_dipa' => 'required',
            'jumlah' => 'required',
            'dasar_pengadaan' => 'nullable',
            'file_pendukung' => 'nullable',
            'tgl_kegiatan_pengadaan' => 'required'
        ];
    }
}
