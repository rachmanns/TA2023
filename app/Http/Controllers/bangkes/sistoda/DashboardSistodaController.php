<?php

namespace App\Http\Controllers\bangkes\sistoda;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\EventBuku;
use App\Models\KatBuku;
use App\Models\Supervisi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardSistodaController extends Controller
{
    public function index()
    {
        $active_menu = 'dashboard_sistoda';
        $jumlah_buku = KatBuku::withCount('buku')->get();
        $kegiatan_sistoda = $this->kegiatan_sistoda();
        return view('bangkes.subbid_sistoda.dashboard_sistoda', compact('active_menu', 'jumlah_buku', 'kegiatan_sistoda'));
    }

    public function kegiatan_sistoda()
    {
        $sosialisasi = EventBuku::with('buku')->get();
        $supervisi = Supervisi::get();
        $year = date('Y');
        $month = date('m');
        $data = [];
        $data['initial_date'] = $year . '-' . $month;
        foreach ($sosialisasi as $key => $value) {
            $data['events'][] = [
                'id' => $value->id_event_buku,
                'title' => '<div class="bg-success p-50 text-white rounded"><span class="font-weight-bolder font-medium-2">Sosialisasi</span><p class="mb-0"> <span style="word-wrap: break;">' . $value->buku->nama_buku . '</span> </p></div>',
                'start' => $value->tgl_event,
                'end' => $value->tgl_event,
                'prefix' => 'sosialisasi'
            ];
        }
        foreach ($supervisi as $key => $value) {
            $data['events'][] = [
                'id' => $value->id_supervisi,
                'title' => '<div class="bg-warning p-50 text-white rounded"><span class="font-weight-bolder font-medium-2">Supervisi</span><p class="mb-0">' . $value->topik . '</p></div>',
                'start' => $value->tgl,
                'end' => $value->tgl,
                'prefix' => 'supervisi'
            ];
        }
        return $data;
    }

    public function detail_jadwal(string $id, string $prefix)
    {
        if ($prefix == 'sosialisasi') {
            $data = $this->detail_sosialisasi($id);
        } else {
            $data = $this->detail_supervisi($id);
        }

        return $data;
    }

    public function detail_sosialisasi(string $id)
    {
        $event_buku = EventBuku::with('buku', 'kota_kab')->where('id_event_buku', $id)->firstOrFail();
        $data = [
            'judul' => $event_buku->buku->nama_buku,
            'tgl' => $event_buku->tgl_event,
            'nomor' => $event_buku->buku->no_buku,
            'jml' => $event_buku->jml_peserta,
            'lokasi' => $event_buku->kota_kab->nama_kotakab
        ];

        return $data;
    }

    public function detail_supervisi(string $id)
    {
        # code...
    }

    public function detail_jumlah($kat_buku)
    {
        $buku = Buku::with('kategori_buku')->where('id_kat_buku', $kat_buku)->get();
        return DataTables::of($buku)
            ->addColumn('file_buku', function ($row) {
                return "<div class='text-center'><a href='" . asset('storage/' . $row->file_buku) . "'><u><i data-feather='paperclip' class='mr-50'></i>Lihat Dokumen</u></a></div>";
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><a href='" . route('bangkes.buku.edit', $row->id_buku) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_buku . "' data-url='" . url('bangkes/buku') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['file_buku', 'action'])
            ->toJson();
    }
}
