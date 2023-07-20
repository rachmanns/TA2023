<?php

namespace App\Http\Controllers\matfaskes\kegiatan;

use App\Http\Controllers\Controller;
use App\Models\InTktm;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TktmController extends Controller
{
    public function index()
    {
        $active_menu = 'tktm';
        return view('matfaskes.kegiatan.tktm.index', compact('active_menu'));
    }

    public function list(Request $request)
    {
        $in_tktm = InTktm::with('vendor')
            ->whereYear('tgl_kontrak_tktm', $request->year)
            ->get();

        return DataTables::of($in_tktm)
            ->editColumn('nominal', function ($query) {
                return "Rp" . number_format($query->nominal, 0, ',', '.');
            })
            ->editColumn('pelaksana_tktm', function ($query) {
                return $query->vendor->nama_vendor;
            })
            ->addColumn('no_kontrak_tktm', function ($query) {
                $btn = $query->no_kontrak_tktm . " <br> <div class='mt-50'><a href='" . route('matfaskes.tktm.pdf_kontrak_tktm', $query->file_kontrak_tktm) . "'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";

                return $btn;
            })
            ->addColumn('tgl_kontrak_tktm', function ($query) {
                $btn = date('j F Y', strtotime($query->tgl_kontrak_tktm)) . " <br> Masa Berlaku:  hari";

                return $btn;
            })
            ->addColumn('tahun', function ($query) {
                $btn = date('Y', strtotime($query->tgl_kontrak_tktm));

                return $btn;
            })
            ->rawColumns(['no_kontrak_tktm', 'tgl_kontrak_tktm'])
            ->toJson();
    }

    public function pdf_kontrak_tktm($file_kontrak_tktm)
    {
        $pathToFile = public_path('logistik/transfer_masuk') . '/' . $file_kontrak_tktm;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}
