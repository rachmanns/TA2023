<?php

namespace App\Http\Controllers\bidum\personil;

use App\Http\Controllers\Controller;
use App\Models\ConfigModel;
use App\Models\Kategori;
use App\Models\Personil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PensiunController extends Controller
{
    public function index($hbd = null)
    {
        $active_menu = 'pensiun';
        return view('bidum.personil.pensiun.index', compact('active_menu', 'hbd'));
    }

    public function list($month_year, $hbd = null)
    {

        if ($hbd == null) {
            $personil = $this->get_pensiun($month_year);
        } else {
            $personil = $this->get_hbd($month_year);
        }

        return DataTables::of($personil)
            ->addIndexColumn()
            ->addColumn('usia', function ($query) {
                $month_year_birthday = date('Y-m', strtotime($query->tgl_lahir));
                $age = Carbon::parse($month_year_birthday)->age;
                return $age;
            })
            ->addColumn('status', function ($query) {
                return 'AKTIF';
            })
            ->rawColumns(['usia'])
            ->toJson();
    }

    public function get_pensiun($date)
    {

        $date_parse = date('Y-m-01', strtotime($date));

        $personil = Personil::select('id_personil', 'nama', 'tgl_lahir', 'tmt_tni', 'nama_pangkat_terakhir', 'id_pangkat_terakhir')->with('pangkat:id_pangkat,usia_pensiun')->whereHas(
            'kategori',
            function ($query) {
                $query->where('nama_kategori', Kategori::AKTIF);
            }
        )->get();

        $data = [];

        foreach ($personil as $k => $v) {
            $bulan_lahir = date('m', strtotime($v->tgl_lahir));
            $bulan_berjalan = date('m', strtotime($date));

            if ($bulan_lahir == $bulan_berjalan) {
                $usia = Carbon::parse($v->tgl_lahir)->diff(Carbon::parse($date_parse))->format('%y');

                if ($usia == $v->pangkat->usia_pensiun) $data[] = $v;
            }
        }

        return $data;
    }

    public function get_hbd($date)
    {
        $month = date('m', strtotime($date));

        $personil = Personil::with('pangkat')
            ->whereHas(
                'kategori',
                function ($query) {
                    $query->where('nama_kategori', Kategori::AKTIF);
                }
            )->whereMonth('tgl_lahir', $month)
            ->get();

        return $personil;
    }
}
