<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class TransaksiMasukController extends Controller
{
    public function index_aset()
    {
        $active_menu = 'aset_masuk';
        $vendor = Vendor::select('id_vendor', 'nama_vendor')->get();
        return view('bidum.logistik.transaksi_masuk.aset.index', compact('active_menu', 'vendor'));
    }

    public function index_persediaan()
    {
        $active_menu = 'persediaan_masuk';
        $vendor = Vendor::select('id_vendor', 'nama_vendor')->get();
        return view('bidum.logistik.transaksi_masuk.persediaan.index', compact('active_menu', 'vendor'));
    }
}
