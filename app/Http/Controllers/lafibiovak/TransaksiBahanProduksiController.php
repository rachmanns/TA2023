<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\BahanProduksi;
use App\Models\TransaksiBahanProduksi;

class TransaksiBahanProduksiController extends Controller
{
    public function index($idb)
    {
        $data = BahanProduksi::find($idb);
        return view('lafibiovak.bahan_baku.transaksi.index', ['active_menu' => 'transaksi_bahan_baku', 'data' => $data]);
    }

    public function list(Request $request, $idb)
    {
        $data = TransaksiBahanProduksi::where('id_bahan_produksi', $idb)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'><button title='Edit' class='btn text-primary p-0 pr-50' data-id='" . $row->id_transaksi . "' data-tgl='" . $row->tanggal . "' data-jml='" . $row->jumlah . "' onclick='edit_trx($(this))'><i data-feather='edit' class='font-medium-4'></i></button></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $idb)
    {
        $d = new TransaksiBahanProduksi;
        $d->id_bahan_produksi = $idb;
        $d->tanggal = $request->tgl;
        $d->jumlah = $request->jml;
        $d->save();
        $d = BahanProduksi::find($idb);
        $d->stok += $request->jml;
        $d->save();
        return response()->json(["error" => false, "message" => 'Data berhasil disimpan']);
    }

    public function show($id)
    {
        $data = TransaksiBahanProduksi::find($id);
        if ($data) return response()->json(["error" => false, "data" => $data]);
        else return response()->json(["error" => true, "message" => "Data Not Found"]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $idb, $id)
    {
        $d = TransaksiBahanProduksi::find($id);
        $d->tanggal = $request->tgl;
        $jml = $d->jumlah;
        $d->jumlah = $request->jml;
        $d->save();
        $d = BahanProduksi::find($idb);
        $d->stok = $d->stok - $jml + $request->jml;
        $d->save();
        return response()->json(["error" => false, "message" => 'Data berhasil disimpan']);
    }

    public function destroy($id)
    {
        //
    }
}
