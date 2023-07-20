<?php

namespace App\Http\Controllers\bangkes;

use App\Http\Controllers\Controller;
use App\Models\KatBuku;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $data = [
            'active_menu' => 'kategori_regulasi'
        ];
        return view('bangkes.master_data.kategori_regulasi.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_kat_buku' => 'required'
        ]);
        try {
            KatBuku::create($validateData);
            return response()->json([
                'error' => false,
                'message' => 'Kategori Created!',
                'modal' => '#jp',
                'table' => '#kategori'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show(KatBuku $kategori_buku)
    {
        return $kategori_buku;
    }

    public function update(Request $request, KatBuku $kategori_buku)
    {
        $validateData = $request->validate([
            'nama_kat_buku' => 'required'
        ]);
        try {
            $kategori_buku->update($validateData);
            return response()->json([
                'error' => false,
                'message' => 'Kategori Updated!',
                'modal' => '#jp',
                'table' => '#kategori'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(KatBuku $kategori_buku)
    {
        try {
            $kategori_buku->delete();
            return response()->json([
                'error' => false,
                'message' => 'Kategori Deleted!',
                'table' => '#kategori'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function get()
    {
        $kat_buku = KatBuku::get();
        return DataTables::of($kat_buku)
            ->addIndexColumn()
            ->addColumn('action', function ($r) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $r->id_kat_buku . '" onclick="edit_kat_buku($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $r->id_kat_buku . '" data-url="' . url('bangkes/kategori-buku') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
