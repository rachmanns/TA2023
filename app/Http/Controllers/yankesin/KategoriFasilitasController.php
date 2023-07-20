<?php

namespace App\Http\Controllers\yankesin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriFasilitasRequest;
use App\Models\KategoriFasilitas;
use App\Services\KategoriFasilitasService;
use Illuminate\Http\Request;

class KategoriFasilitasController extends Controller
{
    public function index()
    {
        return view('yankesin.kategori_fasilitas.index');
    }

    public function get()
    {
        return KategoriFasilitasService::dataTable();
    }

    public function show(KategoriFasilitas $kategori_fasilitas)
    {
        return $kategori_fasilitas;
    }

    public function store(KategoriFasilitasRequest $request)
    {
        KategoriFasilitasService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'Kategori Fasilitas Created!',
            'modal' => '#kf',
            'table' => '#kategori-fasilitas'
        ]);
    }

    public function update(KategoriFasilitasRequest $request, KategoriFasilitas $kategori_fasilitas)
    {
        KategoriFasilitasService::update($request, $kategori_fasilitas);

        return response()->json([
            'error' => false,
            'message' => 'Kategori Fasilitas Updated!',
            'modal' => '#kf',
            'table' => '#kategori-fasilitas'
        ]);
    }

    public function destroy(KategoriFasilitas $kategori_fasilitas)
    {
        KategoriFasilitasService::destroy($kategori_fasilitas);

        return response()->json([
            'error' => false,
            'message' => 'Kategori Fasilitas Delete!',
            'modal' => '#kf',
            'table' => '#kategori-fasilitas'
        ]);
    }
}
