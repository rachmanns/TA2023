<?php

namespace App\Services;

use App\Http\Requests\KategoriDukRequest;
use App\Models\KategoriDuk;
use App\Models\KegiatanDuk;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class KategoriDukService
{
    public static function dataTable(): JsonResponse
    {
        $kategori_duk = KategoriDuk::with('jenis_keg_duk')->latest()->get();
        return DataTables::of($kategori_duk)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_kat_duk . '" onclick="edit_kategori_duk($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_kat_duk . '" data-url="' . url('dukkesops/kategori-duk') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function store(KategoriDukRequest $request): KategoriDuk
    {
        return KategoriDuk::create($request->validated());
    }

    public static function show(KategoriDuk $kategori_duk): KategoriDuk
    {
        return $kategori_duk;
    }

    public static function update(KategoriDukRequest $request, KategoriDuk $kategori_duk): KategoriDuk
    {
        $kategori_duk->update($request->validated());
        return $kategori_duk;
    }

    public static function destroy(KategoriDuk $kategori_duk): Bool
    {
        $kegiatan_duk = KegiatanDuk::where('id_kat_duk', $kategori_duk->id_kat_duk)->first();
        if ($kegiatan_duk) throw new Exception("Cannot delete this data, please check kegiatan first.");
        return $kategori_duk->deleteOrFail();
    }
}
