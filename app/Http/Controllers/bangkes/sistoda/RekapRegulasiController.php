<?php

namespace App\Http\Controllers\bangkes\sistoda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RekapRegulasiController extends Controller
{
    public function index()
    {
        $active_menu = 'data_regulasi';
        return view('bangkes.subbid_sistoda.regulasi.data_regulasi', compact(
            'active_menu'
        ));
    }

    public function get()
    {
        $rekap_regulasi = DB::table('bidang')->leftJoin('regulasi', 'regulasi.id_bidang', 'bidang.id_bidang')
            ->select('kode_bidang', DB::raw('count(id_regulasi) as total_regulasi'))
            ->groupBy('kode_bidang')
            ->get();
        return DataTables::of($rekap_regulasi)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return  "<div class='text-center'><a href='" . url('regulasi/' . $row->kode_bidang) . "'><button title='Detail' class='btn text-primary p-0 pr-75'><i data-feather='file-text' class='font-medium-4'></i></button></a></div>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
