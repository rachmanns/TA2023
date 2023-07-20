<?php

namespace App\Http\Controllers\kermabaktikes\kerma;

use App\Http\Controllers\Controller;
use App\Models\LokasiAcara;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MapsKermaController extends Controller
{
    public function index()
    {
        $lokasi_acara = LokasiAcara::query();

        $kerma = $lokasi_acara->clone()->select(
            'lokasi_acara.nama_tempat',
            'lokasi_acara.latitude',
            'lokasi_acara.longitude',
            'acara_kerma.nama_acara',
            'acara_kerma.tgl_pelaksanaan',
            'acara_kerma.tempat',
            'acara_kerma.periode',
            'kegiatan.nama_kegiatan',
            'event.nama_event',
            'jenis_kerma.jenis_kerma',
            'jenis_kegiatan.jenis_keg',
            'jenis_kegiatan.kategori_keg',
            'status.nama_status',
            'keterangan.keterangan'
        )
            ->join('acara_kerma', 'acara_kerma.id_kerma', 'lokasi_acara.id_kerma')
            ->join('kegiatan', 'acara_kerma.id_kegiatan', 'kegiatan.id_kegiatan')
            ->join('jenis_kegiatan', 'jenis_kegiatan.id_jenis_keg', 'acara_kerma.id_jenis_keg')
            ->join('event', 'event.id_event', 'kegiatan.id_event')
            ->join('jenis_kerma', 'event.id_jenis_kerma', 'jenis_kerma.id_jenis_kerma')
            ->join('status', 'acara_kerma.id_status', 'status.id_status')
            ->join('keterangan', 'acara_kerma.id_keterangan', 'keterangan.id_keterangan')
            ->get();

        $bakti = $lokasi_acara->clone()->select(
            'lokasi_acara.nama_tempat',
            'lokasi_acara.latitude',
            'lokasi_acara.longitude',
            'acara_bakti.nama_acara',
            'acara_bakti.tgl_pelaksanaan',
            'acara_bakti.tempat',
            'acara_bakti.periode',
            'jenis_kegiatan.jenis_keg',
            'jenis_kegiatan.kategori_keg',
            'keterangan.keterangan'
        )
            ->join('acara_bakti', 'acara_bakti.id_bakti', 'lokasi_acara.id_kerma')
            ->join('jenis_kegiatan', 'jenis_kegiatan.id_jenis_keg', 'acara_bakti.id_jenis_keg')
            ->join('keterangan', 'acara_bakti.id_keterangan', 'keterangan.id_keterangan')
            ->get();

        $lokasi_acara = array_merge($kerma->toArray(), $bakti->toArray());

        return view('kermabaktikes.maps', [
            'active_menu' => 'maps_kerma',
            'lokasi_acara' => $lokasi_acara
        ]);
    }
}
