<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Produk;
use App\Models\ZatAktif;

class ProdukController extends Controller
{
    public function index()
    {
        return view('lafibiovak.daftar_obat.zat_aktif_obat.index', ['active_menu' => 'zat_aktif_obat']);
    }

    public function list()
    {
        $data = Produk::with('zat_aktif')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'><a href='/lafibiovak/produk/" . $row->id_produk . "/edit'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_produk . "' data-url='/lafibiovak/produk'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('lafibiovak.daftar_obat.zat_aktif_obat.create', ['active_menu' => 'zat_aktif_obat']);
    }

    public function store(Request $request)
    {
        $d = new Produk;
        $d->kategori_produk = $request->kategori;
        $d->nama_produk = $request->nama_produk;
        $d->save();
        foreach($request->zat_aktif as $za) {
            $z = new ZatAktif;
            $z->nama_zat = $za['zat'];
            $z->takaran = $za['takaran'];
            $z->id_produk = $d->id_produk;
            $z->save();
        }
        return response()->json(["error" => false, "message" => 'Produk berhasil disimpan']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $d = Produk::with('zat_aktif')->where('id_produk', $id)->first();
        return view('lafibiovak.daftar_obat.zat_aktif_obat.create', ['active_menu' => 'zat_aktif_obat', 'data' => $d]);
    }

    public function update(Request $request, $id)
    {
        $d = Produk::find($id);
        $d->kategori_produk = $request->kategori;
        $d->nama_produk = $request->nama_produk;
        $d->save();
        ZatAktif::where('id_produk', $id)->delete();
        foreach($request->zat_aktif as $za) {
            $z = new ZatAktif;
            $z->nama_zat = $za['zat'];
            $z->takaran = $za['takaran'];
            $z->id_produk = $d->id_produk;
            $z->save();
        }
        return response()->json(["error" => false, "message" => 'Produk berhasil disimpan']);
    }

    public function destroy($id)
    {
        $d = Produk::with('kemasan')->find($id);
        if (count($d->kemasan) > 0) return response()->json([
            "error" => false,
            "message" => "Produk tidak bisa dihapus karena ada di kemasan",
        ]);
        $d->delete();
        ZatAktif::where('id_produk', $id)->delete();
        return response()->json([
            "error" => false,
            "message" => "Produk berhasil dihapus",
            'table' => '#produk',
        ]);
    }
}
