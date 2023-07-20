<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\KategoriBahanProduksi;
use App\Models\BahanProduksi;
use App\Models\DetilBahanRenprod;

class BahanProduksiController extends Controller
{
    public function index()
    {
        return view('lafibiovak.bahan_baku.persediaan.index', ['active_menu' => 'persediaan_bahan_baku']);
    }

    public function list(Request $request)
    {
        $data = BahanProduksi::with('kategori')->withSum('transaksi', 'jumlah');
        if (isset($request->kategori)) $data->where('id_kategori', $request->kategori);
        $data = $data->get();
        foreach($data as $d) {
            if (!isset($d->transaksi_sum_jumlah)) $d->transaksi_sum_jumlah = 0;
            $lafi = DetilBahanRenprod::selectRaw('id_pelaksana, COALESCE(SUM(jumlah), 0) AS jumlah')->where('id_bahan_produksi', $d->id_bahan_produksi)->groupBy('id_pelaksana')->get();
            $d->Lafiad = 0;
            $d->Lafial = 0;
            $d->Lafiau = 0;
            $d->Labiomed = 0;
            $d->Labiovak = 0;
            foreach($lafi as $la) {
                $l = $la->id_pelaksana;
                $d->$l = intval($la->jumlah);
            }
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'><a href='/lafibiovak/bahan-produksi/" . $row->id_bahan_produksi . "/edit'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_bahan_produksi . "' data-url='/lafibiovak/bahan-produksi'><i data-feather='trash' class='font-medium-4 text-danger'></i></button> <a href='/lafibiovak/transaksi-bahan-produksi/" . $row->id_bahan_produksi . "/data'><button title='Transaksi' class='btn text-primary p-0 pr-50'><i data-feather='file-text' class='font-medium-4'></i></button></a></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $k = KategoriBahanProduksi::get();
        return view('lafibiovak.bahan_baku.persediaan.create', ['active_menu' => 'persediaan_bahan_baku', 'kategori' => $k]);
    }

    public function store(Request $request)
    {
        $d = new BahanProduksi;
        $d->id_kategori = $request->kategori;
        $d->nama_bahan_produksi = $request->nama;
        $d->satuan = $request->satuan;
        $d->spesifikasi = $request->spesifikasi;
        $d->kemasan_min = $request->kemasan;
        $d->perusahaan = $request->perusahaan;
        $d->negara = $request->asal;
        $d->renada = $request->renada;
        $d->jumlah_awal = $request->awal;
        $d->keterangan = $request->ket;
        $d->save();
        return response()->json(["error" => false, "message" => 'Bahan Produksi berhasil disimpan']);
    }

    public function show(Request $request, $id)
    {
        $data = BahanProduksi::find($id);
        if ($data) {
            return response()->json(["error" => false, "data" => $data]);
        } else {
            return response()->json(["error" => true, "message" => "Data Not Found"]);
        }
    }

    public function edit($id)
    {
        $k = KategoriBahanProduksi::get();
        $d = BahanProduksi::find($id);
        return view('lafibiovak.bahan_baku.persediaan.create', ['active_menu' => 'persediaan_bahan_baku', 'kategori' => $k, 'data' => $d]);
    }

    public function update(Request $request, $id)
    {
        $d = BahanProduksi::find($id);
        $d->id_kategori = $request->kategori;
        $d->nama_bahan_produksi = $request->nama;
        $d->satuan = $request->satuan;
        $d->spesifikasi = $request->spesifikasi;
        $d->kemasan_min = $request->kemasan;
        $d->perusahaan = $request->perusahaan;
        $d->negara = $request->asal;
        $d->renada = $request->renada;
        $d->jumlah_awal = $request->awal;
        $d->keterangan = $request->ket;
        $d->save();
        return response()->json(["error" => false, "message" => 'Bahan Produksi berhasil disimpan']);
    }

    public function destroy($id)
    {
        $d = BahanProduksi::with('detil_bahan_renprod')->find($id);
        if (count($d->detil_bahan_renprod) > 0) return response()->json([
            "error" => false,
            "message" => "Bahan produksi tidak boleh dihapus",
        ]);
        $d->delete();
        return response()->json([
            "error" => false,
            "message" => "Bahan Produksi berhasil dihapus",
            'table' => '#bahan-baku',
        ]);
    }
}
