<?php

namespace App\Http\Controllers\bangkes\sdm;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SelesaiInternshipController extends Controller
{
    public function index()
    {
        $active_menu = 'selesai_internship';
        return view('bangkes.subbid_sdm.internship.selesai.index', compact('active_menu'));
    }

    public function list(Request $request)
    {
        $internship = Internship::whereNotNull('tgl_selesai')
            ->when($request->tahun, function ($query) use ($request) {
                return $query->whereYear('tgl_selesai', $request->tahun);
            })
            ->latest()->get();
        return DataTables::of($internship)
            ->editColumn('tgl_mulai', function ($row) {
                return indonesian_date_format($row->tgl_mulai);
            })
            ->editColumn('tgl_selesai', function ($row) {
                if (!empty($row->tgl_selesai)) {
                    return indonesian_date_format($row->tgl_selesai);
                }
            })
            ->addColumn('pangkat_korps', function ($row) {
                return $row->pangkat . '/' . $row->korps;
            })
            ->addColumn('jabatan_kesatuan', function ($row) {
                return $row->jabatan . '/' . $row->kesatuan;
            })
            // ->addColumn('pangkat', function ($row) {
            //     $pangkat = $row->pangkat ?? '-';
            //     return "<div class='text-center'> " . $pangkat . " <br> " . $row->no_identitas . " </div>";
            // })
            // ->addColumn('action', function ($row) {
            //     return "<div class='text-center'><a href='" . route('bangkes.paramedis.edit', $row->id_paramedis) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_paramedis . "' data-url='" . url('bangkes/paramedis') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            // })
            // ->rawColumns(['jenis_paramedis', 'action', 'id_spesialis', 'pangkat'])
            ->rawColumns(['pangkat_korps'])
            ->toJson();
    }
}
