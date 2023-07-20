<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\KategoriBahanProduksi;

class KategoriBahanProduksiController extends Controller
{
    public function index()
    {
        return view('lafibiovak.bahan_baku.kategori.index', ['active_menu' => 'kategori_bahan_baku']);
    }

    public function list(Request $request)
    {
        $data = KategoriBahanProduksi::all();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'><button title='Edit' class='btn text-primary p-0 pr-50' data-id='" . $row->id_kategori . "' data-nama='" . $row->nama_kategori . "' onclick='edit_kat($(this))'><i data-feather='edit' class='font-medium-4'></i></button><button title='Delete' class='delete-data btn p-0' data-id='" . $row->id_kategori . "' data-url='/lafibiovak/kategori-bahan-produksi'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $d = new KategoriBahanProduksi;
        $d->nama_kategori = $request->kategori;
        $d->save();
        return response()->json(["error" => false, "message" => 'Data berhasil disimpan']);
    }

    public function show($id)
    {
        $data = KategoriBahanProduksi::find($id);
        if ($data) return response()->json(["error" => false, "data" => $data]);
        else return response()->json(["error" => true, "message" => "Data Not Found"]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $d = KategoriBahanProduksi::find($id);
        $d->nama_kategori = $request->kategori;
        $d->save();
        return response()->json(["error" => false, "message" => 'Data berhasil disimpan']);
    }

    public function destroy($id)
    {
        $d = KategoriBahanProduksi::with('bahan_produksi')->find($id);
        if (count($d->bahan_produksi) > 0) return response()->json([
            "error" => false,
            "message" => "Kategori tidak boleh dihapus",
        ]);
        $d->delete();
        return response()->json([
            "error" => false,
            "message" => "Data berhasil dihapus",
            'table' => '#kategori',
        ]);
    }
}
