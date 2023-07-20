<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SatuanProduk;
use App\Models\TahapProduksi;

class SatuanProdukController extends Controller
{
    public function index()
    {
        return view('lafibiovak.daftar_obat.jenis_obat.index', ['active_menu' => 'jenis_obat']);
    }

    public function list()
    {
        $data = SatuanProduk::with('tahap_produksi')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'><a href='/lafibiovak/satuan-produk/" . $row->id_satuan_produk . "/edit'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_satuan_produk . "' data-url='/lafibiovak/satuan-produk'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('lafibiovak.daftar_obat.jenis_obat.create', ['active_menu' => 'jenis_obat']);
    }

    public function store(Request $request)
    {
        $d = new SatuanProduk;
        $d->nama_satuan = $request->satuan_produk;
        $d->save();
        $i = 1;
        foreach($request->tahap_produksi as $tp) {
            $t = new TahapProduksi;
            $t->nama_tahap = $tp['tahap'];
            $t->no_urut = $i++;
            $t->id_satuan_produk = $d->id_satuan_produk;
            $t->save();
        }
        return response()->json(["error" => false, "message" => 'Satuan produk berhasil disimpan']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $d = SatuanProduk::with('tahap_produksi')->where('id_satuan_produk', $id)->first();
        return view('lafibiovak.daftar_obat.jenis_obat.create', ['active_menu' => 'jenis_obat', 'data' => $d]);
    }

    public function update(Request $request, $id)
    {
        $d = SatuanProduk::find($id);
        $d->nama_satuan = $request->satuan_produk;
        $d->save();
        TahapProduksi::where('id_satuan_produk', $id)->delete();
        $i = 1;
        foreach($request->tahap_produksi as $tp) {
            $t = new TahapProduksi;
            $t->nama_tahap = $tp['tahap'];
            $t->no_urut = $i++;
            $t->id_satuan_produk = $d->id_satuan_produk;
            $t->save();
        }
        return response()->json(["error" => false, "message" => 'Satuan produk berhasil disimpan']);
    }

    public function destroy($id)
    {
        $d = SatuanProduk::with('kemasan')->find($id);
        if (count($d->kemasan) > 0) return response()->json([
            "error" => false,
            "message" => "Satuan Produk tidak bisa dihapus karena ada di kemasan",
        ]);
        $d->delete();
        TahapProduksi::where('id_satuan_produk', $id)->delete();
        return response()->json([
            "error" => false,
            "message" => "Satuan produk berhasil dihapus",
            'table' => '#produk',
        ]);
    }
}
