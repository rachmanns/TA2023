<?php

namespace App\Http\Controllers\dukkesops\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriDukRequest;
use App\Models\JenisKegDuk;
use App\Models\KategoriDuk;
use App\Services\KategoriDukService;
use Illuminate\Http\Request;

class KategoriDukController extends Controller
{
    public function index()
    {
        $active_menu = 'kategori_duk';
        $jenis_keg_duk = JenisKegDuk::get();
        return view('dukkesops.master_data.kategori_duk', compact('active_menu', 'jenis_keg_duk'));
    }

    public function get()
    {
        return KategoriDukService::dataTable();
    }

    public function store(KategoriDukRequest $request)
    {
        KategoriDukService::store($request);
        return response()->json([
            'error' => false,
            'message' => 'Kategori Created!',
            'modal' => '#tambah',
            'table' => '#kategori-duk-table'
        ]);
    }

    public function edit(KategoriDuk $kategori_duk)
    {
        return KategoriDukService::show($kategori_duk);
    }

    public function update(KategoriDukRequest $request, KategoriDuk $kategori_duk)
    {
        KategoriDukService::update($request, $kategori_duk);
        return response()->json([
            'error' => false,
            'message' => 'Kategori Updated!',
            'modal' => '#tambah',
            'table' => '#kategori-duk-table'
        ]);
    }

    public function destroy(KategoriDuk $kategori_duk)
    {
        try {
            KategoriDukService::destroy($kategori_duk);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Kategori Deleted!',
            'table' => '#kategori-duk-table'
        ]);
    }
}
