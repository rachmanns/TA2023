<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Kemasan;
use App\Models\Produk;
use App\Models\SatuanProduk;

class KemasanController extends Controller
{
    public function index()
    {
        return view('lafibiovak.daftar_obat.kemasan_obat.index', ['active_menu' => 'kemasan_obat']);
    }

    public function list()
    {
        $data = Kemasan::with('produk.zat_aktif', 'satuan_produk')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'><a href='/lafibiovak/kemasan/" . $row->id_kemasan . "/edit'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_kemasan . "' data-url='/lafibiovak/kemasan'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $p = Produk::get();
        $sp = SatuanProduk::get();
        return view('lafibiovak.daftar_obat.kemasan_obat.create', ['active_menu' => 'kemasan_obat', 'prods' => $p, 'satprods' => $sp]);
    }

    public function store(Request $request)
    {
        $d = new Kemasan;
        $d->id_produk = $request->produk;
        $d->id_satuan_produk = $request->satuan;
        $d->nama_kemasan = $request->kemasan;
        $d->NIE = $request->nie;
        $d->bets = $request->bets;
        $d->save();
        if ($request->file('gambar') !== null) {
            $file = $request->file('gambar');
            $filename = $d->id_kemasan . '.jpg';
            $file->move(public_path('uploads/kemasan'), $filename);
        }
        return response()->json(["error" => false, "message" => 'Kemasan berhasil disimpan']);
    }

    public function show(Request $request, $id)
    {
        $data = Kemasan::find($id);
        if ($data) {
            if (isset($request->renprod)) $data->bets = number_format($data->bets, 0, '', '.');
            return response()->json(["error" => false, "data" => $data]);
        } else {
            return response()->json(["error" => true, "message" => "Data Not Found"]);
        }
    }

    public function edit($id)
    {
        $p = Produk::get();
        $sp = SatuanProduk::get();
        $d = Kemasan::find($id);
        return view('lafibiovak.daftar_obat.kemasan_obat.create', ['active_menu' => 'kemasan_obat', 'prods' => $p, 'satprods' => $sp, 'data' => $d]);
    }

    public function update(Request $request, $id)
    {
        $d = Kemasan::find($id);
        $d->id_produk = $request->produk;
        $d->id_satuan_produk = $request->satuan;
        $d->nama_kemasan = $request->kemasan;
        $d->NIE = $request->nie;
        $d->bets = $request->bets;
        $d->save();
        if ($request->file('gambar') !== null) {
            $file = $request->file('gambar');
            $filename = $d->id_kemasan . '.jpg';
            $file->move(public_path('uploads/kemasan'), $filename);
        }
        return response()->json(["error" => false, "message" => 'Kemasan berhasil disimpan']);
    }

    public function destroy($id)
    {
        $d = Kemasan::with('renprod')->find($id);
        if (count($d->renprod) > 0) return response()->json([
            "error" => false,
            "message" => "Kemasan tidak bisa dihapus karena ada di produksi",
        ]);
        $d->delete();
        return response()->json([
            "error" => false,
            "message" => "Kemasan berhasil dihapus",
            'table' => '#kemasan',
        ]);
    }
}
