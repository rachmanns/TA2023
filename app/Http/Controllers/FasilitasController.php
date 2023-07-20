<?php

namespace App\Http\Controllers;

use App\Http\Requests\FasilitasRequest;
use App\Models\Fasilitas;
use App\Models\KategoriFasilitas;
use App\Models\RumahSakit;
use App\Models\FasilitasRS;
use App\Services\FasilitasService;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $active_menu = 'fasilitas';
        $kategori_fasilitas = KategoriFasilitas::whereNotIn('nama_kategori', ['Nakes', 'Paramedis'])->get();
        return view('yankesin.fasilitas.index', compact(
            'active_menu',
            'kategori_fasilitas'
        ));
    }

    public function get()
    {
        return FasilitasService::dataTable();
    }

    public function show(Fasilitas $fasilitas)
    {
        return $fasilitas;
    }

    public function store(FasilitasRequest $request)
    {
        $fas = FasilitasService::store($request);
        $rs = RumahSakit::select('id_rs')->get();
        foreach($rs as $d) {
            FasilitasRS::create([
                'id_fasilitas' => $fas->id_fasilitas,
                'id_rs' => $d->id_rs,
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Fasilitas Created!',
            'modal' => '#kf',
            'table' => '#fasilitas'
        ]);
    }

    public function update(FasilitasRequest $request, Fasilitas $fasilitas)
    {
        FasilitasService::update($request, $fasilitas);

        return response()->json([
            'error' => false,
            'message' => 'Fasilitas Updated!',
            'modal' => '#kf',
            'table' => '#fasilitas'
        ]);
    }

    public function destroy(Fasilitas $fasilitas)
    {
        FasilitasRS::where('id_fasilitas', $fasilitas->id_fasilitas)->delete();
        FasilitasService::destroy($fasilitas);

        return response()->json([
            'error' => false,
            'message' => 'Fasilitas Delete!',
            'modal' => '#kf',
            'table' => '#fasilitas'
        ]);
    }
}
