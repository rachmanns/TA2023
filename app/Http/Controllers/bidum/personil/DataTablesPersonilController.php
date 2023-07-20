<?php

namespace App\Http\Controllers\bidum\personil;

use App\Http\Controllers\Controller;
use App\Models\Bahasa;
use App\Models\Keluarga;
use App\Models\PendMiliterPers;
use App\Models\PendUmumPers;
use App\Models\Penugasan;
use App\Models\RiwayatJabatan;
use App\Models\RiwayatPangkat;
use App\Models\TandaJasa;
use App\Models\TandaJasaPers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataTablesPersonilController extends Controller
{
    public function list_keluarga($id_personil)
    {
        $keluarga = Keluarga::where('id_personil', $id_personil)->get();
        return DataTables::of($keluarga)
            ->addColumn('tempat_tgl_lahir', function ($query) {
                return $query->tempat_lahir . ', ' . date('d F Y', strtotime($query->tgl_lahir));
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-url="' . route('bidum.personil.get_keluarga', $query->id_keluarga) . '" onclick="edit_keluarga($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_keluarga . '" data-url="' . url('bidum/personil/delete/keluarga') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function list_pendidikan_umum($id_personil)
    {
        $pendidikan_umum = PendUmumPers::with('pendidikan_umum')->where('id_personil', $id_personil)->get();
        return DataTables::of($pendidikan_umum)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-url="' . route('bidum.personil.get_pend_umum_pers', $query->id_pend_umum_pers) . '" onclick="edit_pend_umum_pers($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_pend_umum_pers . '" data-url="' . url('bidum/personil/delete/pendidikan-umum') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>
                ';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function list_pendidikan_militer($id_personil)
    {
        $pendidikan_militer = PendMiliterPers::where('id_personil', $id_personil)->get();
        return DataTables::of($pendidikan_militer)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-url="' . route('bidum.personil.get_pend_militer_pers', $query->id_pend_militer_pers) . '" onclick="edit_pend_militer_pers($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_pend_militer_pers . '" data-url="' . url('bidum/personil/delete/pendidikan-militer') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function list_riwayat_pangkat($id_personil)
    {
        $riwayat_pangkat = RiwayatPangkat::with('pangkat')->where('id_personil', $id_personil)->get();
        return DataTables::of($riwayat_pangkat)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-url="' . route('bidum.personil.get_riwayat_pangkat', $query->id_riwayat_pangkat) . '" onclick="edit_riwayat_pangkat($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_riwayat_pangkat . '" data-url="' . url('bidum/personil/delete/riwayat-pangkat') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function list_riwayat_jabatan($id_personil)
    {
        $riwayat_jabatan = RiwayatJabatan::with('jabatan')->where('id_personil', $id_personil)->get();
        return DataTables::of($riwayat_jabatan)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary"  data-url="' . route('bidum.personil.get_riwayat_jabatan', $query->id_riwayat_jabatan) . '" onclick="edit_riwayat_jabatan($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_riwayat_jabatan . '" data-url="' . url('bidum/personil/delete/riwayat-jabatan') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function list_penugasan_dn($id_personil)
    {
        $penugasan = Penugasan::where('id_personil', $id_personil)->where('jenis', Penugasan::DALAM_NEGERI)->get();
        return DataTables::of($penugasan)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-url="' . route('bidum.personil.get_penugasan', $query->id_penugasan) . '" onclick="edit_penugasan($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_penugasan . '" data-url="' . url('bidum/personil/delete/penugasan') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function list_penugasan_ln($id_personil)
    {
        $penugasan = Penugasan::where('id_personil', $id_personil)->where('jenis', Penugasan::LUAR_NEGERI)->get();
        return DataTables::of($penugasan)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-url="' . route('bidum.personil.get_penugasan', $query->id_penugasan) . '" onclick="edit_penugasan($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_penugasan . '" data-url="' . url('bidum/personil/delete/penugasan') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function list_bahasa($id_personil)
    {
        $bahasa = Bahasa::where('id_personil', $id_personil)->get();
        return DataTables::of($bahasa)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-url="' . route('bidum.personil.get_bahasa', $query->id_bahasa) . '" onclick="edit_bahasa($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_bahasa . '" data-url="' . url('bidum/personil/delete/bahasa') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function list_tanda_jasa($id_personil)
    {
        $tanda_jasa = TandaJasaPers::with('tanda_jasa')->where('id_personil', $id_personil)->get();
        return DataTables::of($tanda_jasa)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-url="' . route('bidum.personil.get_tanda_jasa_pers', $query->id_jasa_pers) . '" onclick="edit_tanda_jasa_pers($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_jasa_pers . '" data-url="' . url('bidum/personil/delete/tanda-jasa') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
