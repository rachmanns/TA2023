<?php

namespace App\Http\Controllers;

use App\Imports\PaguAnggaran\PaguAnggaranImport;
use App\Models\Uraian;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PaguAnggaranController extends Controller
{

    private $uraian;

    public function __construct()
    {
        $this->uraian = Uraian::get();
    }


    public function index()
    {
        //return view('pagu_anggaran.index', ['active_menu' => 'daftar_pagu']);

        $total_anggaran = $this->uraian->where('id_parent', null)->sum('pagu_awal');
        $total_pagu_awal_pusat = $this->uraian->where('kode_dipa', 'DIPPUS')->where('id_parent', null)->sum('pagu_awal');
        $total_pagu_awal_daerah = $this->uraian->where('kode_dipa', 'DIPDAR')->where('id_parent', null)->sum('pagu_awal');
        // dd($total_anggaran);
        return view('bidum.anggaran.dashboard_anggaran', compact(
            'total_anggaran',
            'total_pagu_awal_pusat',
            'total_pagu_awal_daerah'
        ));
    }

    public function import_excel(Request $request)
    {
        $excel = Excel::import(new PaguAnggaranImport, $request->file('file'));
        return redirect()->back();
    }

    public function list_pusat()
    {
        $query = Uraian::where('kode_dipa', 'DIPPUS')->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('pagu_awal', function ($pusat) {
                return "Rp" . number_format($pusat->pagu_awal, 0, ',', '.');
            })
            ->toJson();
    }

    public function list_daerah()
    {
        $query = Uraian::where('kode_dipa', 'DIPDAR')->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('pagu_awal', function ($daerah) {
                return "Rp" . number_format($daerah->pagu_awal, 0, ',', '.');
            })
            ->toJson();
    }
}
