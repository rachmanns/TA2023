<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiKeluarController extends Controller
{
    public function index_aset()
    {
        $active_menu = 'aset_keluar';
        return view('bidum.logistik.transaksi_keluar.aset.index', compact('active_menu'));
    }
    public function index_persediaan()
    {
        $active_menu = 'persediaan_keluar';
        return view('bidum.logistik.transaksi_keluar.persediaan.index', compact('active_menu'));
    }

    public function pdf_nota_dinas($file_nota_dinas)
    {
        $pathToFile = public_path('barang_barang_keluar/nota_dinas') . '/' . $file_nota_dinas;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function pdf_spb($file_spb)
    {
        $pathToFile = public_path('barang_barang_keluar/spb') . '/' . $file_spb;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}
